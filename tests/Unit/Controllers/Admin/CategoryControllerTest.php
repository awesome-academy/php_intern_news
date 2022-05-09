<?php

namespace Tests\Unit\Controllers\Admin;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;
use Mockery as m;

class CategoryControllerTest extends TestCase
{
    protected $categoryRepoMock;

    protected $controller;

    protected $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->categoryRepoMock = m::mock(CategoryRepository::class)->makePartial();

        $this->admin = new User();
        $this->admin->setRawAttributes([
            'id' => 1,
            'name' => 'Nguyễn Ngọc Công',
            'username' => 'nncadmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => User::ACTIVE,
            'is_admin' => true,
        ]);
    }

    public function tearDown(): void
    {
        unset($this->categoryRepoMock);
        unset($this->admin);
        m::close();

        parent::tearDown();
    }

    public function testIndex()
    {
        $categories = factory(Category::class, 10)->make();

        $this->categoryRepoMock->shouldReceive('getAllCategories')->andReturn($categories);

        $this->controller = new CategoryController($this->categoryRepoMock);

        $this->actingAs($this->admin);
        $view = $this->controller->index();

        $this->assertEquals('admin.category.index', $view->getName());
        $this->assertArrayHasKey('categoryList', $view->getData());
    }

    public function testEdit()
    {
        $id = 1;

        $category = factory(Category::class)->make([
            'id' => $id,
            'name' => 'Danh muc 1',
            'slug' => 'danh-muc-1',
            'parent_id' => 0,
        ]);

        $this->categoryRepoMock->shouldReceive('getCategory')->with($id)->andReturn($category);

        $this->controller = new CategoryController($this->categoryRepoMock);
        $this->actingAs($this->admin);

        $view = $this->controller->edit($id);

        $this->assertEquals('admin.category.edit', $view->getName());
        $viewData = $view->getData();
        $this->assertArrayHasKey('category', $viewData);


        $this->assertEquals($id, $viewData['category']->id);
    }

    public function testStore()
    {
        $data = [
            'name' => 'Danh muc 1',
            'parent_id' => 0
        ];
        $request = new CategoryRequest($data);
        $category = factory(Category::class)->make([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
            'slug' => Str::slug($data['name']),
        ]);

        $this->categoryRepoMock->shouldReceive('creatCategory')->andReturn($category);
        $this->controller = new CategoryController($this->categoryRepoMock);

        $response = $this->controller->store($request);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('success', session()->all());
    }

    public function testStoreError()
    {
        $data = [
            'name' => 'Danh muc 1',
            'parent_id' => 0
        ];
        $request = new CategoryRequest($data);

        $this->categoryRepoMock->shouldReceive('creatCategory')->andReturn(null);
        $this->controller = new CategoryController($this->categoryRepoMock);

        $response = $this->controller->store($request);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('error', session()->all());
    }

    public function testUpdate()
    {
        $id = 1;

        $data = [
            'name' => 'Danh muc 1 da sua',
            'parent_id' => 0
        ];

        $request = new CategoryRequest($data);

        $options = [
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'parent_id' => $data['parent_id'],
        ];
        $categoryMock = m::mock(Category::class, [
            'id' => $id,
            'name' => 'Danh muc 1',
            'slug' => 'danh-muc-1',
            'parent_id' => 0,
        ])->makePartial();

        $categoryMock->shouldReceive('update')->with($options)->andReturn(true);

        $this->categoryRepoMock->shouldReceive('getCategory')->with($id)->andReturn($categoryMock);

        $this->actingAs($this->admin);

        $this->controller = new CategoryController($this->categoryRepoMock);

        $response = $this->controller->update($request, $id);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('success', session()->all());
    }

    public function testUpdateError()
    {
        $id = 1;

        $data = [
            'name' => 'Danh muc 1 da sua',
            'parent_id' => 0
        ];

        $request = new CategoryRequest($data);

        $options = [
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'parent_id' => $data['parent_id'],
        ];

        $categoryMock = m::mock(Category::class, [
            'id' => $id,
            'name' => 'Danh muc 1',
            'slug' => 'danh-muc-1',
            'parent_id' => 0,
        ])->makePartial();

        $categoryMock->shouldReceive('update')->with($options)->andReturn(false);

        $this->categoryRepoMock->shouldReceive('getCategory')->with($id)->andReturn($categoryMock);

        $this->actingAs($this->admin);

        $this->controller = new CategoryController($this->categoryRepoMock);

        $response = $this->controller->update($request, $id);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('error', session()->all());
    }

    public function testDestroy()
    {
        $id = 1;

        $categoryMock = m::mock(Category::class, [
            'id' => $id,
            'name' => 'Danh muc 1',
            'slug' => 'danh-muc-1',
            'parent_id' => 0,
        ])->makePartial();

        $this->categoryRepoMock->shouldReceive('getCategory')->andReturn($categoryMock);
        
        $belongsToManyMock = m::mock(BelongsToMany::class)->makePartial();
        $belongsToManyMock->shouldReceive('detach')->andReturn(true);

        $categoryMock->shouldReceive('articles')->andReturn($belongsToManyMock);

        $hasManyMock = m::mock(HasMany::class)->makePartial();
        $hasManyMock->shouldReceive('update')->with(['parent_id' => $categoryMock->parent_id])->andReturn(true);

        $categoryMock->shouldReceive('subCategories')->andReturn($hasManyMock);

        $this->actingAs($this->admin);

        $this->controller = new CategoryController($this->categoryRepoMock);

        $response = $this->controller->destroy($id);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('success', session()->all());
    }
}
