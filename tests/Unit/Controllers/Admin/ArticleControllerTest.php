<?php

namespace Tests\Unit\Controllers\Admin;

use App\Events\PublishNotificationEvent;
use App\Http\Controllers\Admin\ArticleController;
use App\Models\Article;
use App\Models\User;
use App\Notifications\PublishNotification;
use App\Repositories\Article\ArticleRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Event;
use Mockery as m;
use Tests\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ArticleControllerTest extends TestCase
{
    protected $articleRepoMock;
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->articleRepoMock = m::mock(app()->make(ArticleRepository::class))->makePartial();
    }

    public function testIndexFunction()
    {
        $articleList = factory(Article::class, 10)->make();

        $this->articleRepoMock->shouldReceive('getArticleListAdmin')->andReturn($articleList);

        $this->controller = new ArticleController($this->articleRepoMock);

        $view = $this->controller->index();
        $data = $view->getData();

        $this->assertEquals('admin.article.index', $view->getName());
        $this->assertArrayHasKey('articles', $data);
        $this->assertEquals($articleList, $data['articles']);
    }

    public function testShowFunction()
    {
        $id = 1;
        $article = factory(Article::class)->make();

        $article->setRawAttributes([
            'id' => $id,
            'title' => 'Tieu de bai viet',
            'content' => 'Noi dung bai viet',
            'slug' => 'tieu-de-bai-viet',
            'published' => Article::PENDING,
        ]);

        $this->articleRepoMock->shouldReceive('getArticleAdmin')->with($id)->andReturn($article);

        $this->controller = new ArticleController($this->articleRepoMock);

        $view = $this->controller->show($id);
        $data = $view->getData();

        $this->assertEquals('admin.article.show', $view->getName());
        $this->assertArrayHasKey('article', $data);
        $this->assertEquals($article, $data['article']);
    }


    public function testChangeStatusFunction()
    {
        $id = 1;
        $status = Article::APPROVED;

        $admin = m::mock(app()->make(User::class))->makePartial();
        $admin->is_admin = true;
        $admin->id = 9999;
        $this->actingAs($admin);

        $article = m::mock(app()->make(Article::class))->makePartial();
        $article->setRawAttributes([
            'id' => $id,
            'title' => 'Tieu de bai viet',
            'content' => 'Noi dung bai viet',
            'slug' => 'tieu-de-bai-viet',
        ]);
        $admin->shouldReceive('notify')->andReturn(true);
        $article->setRelation('author', $admin);

        $notification = new PublishNotification([
            'id' => $id,
            'message' => 'created',
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        $admin->setRelation('notifications', new Collection([$notification]));

        $article->shouldReceive('save')->andReturn(true);
        $this->articleRepoMock->shouldReceive('getArticleAdmin')->with($id)->andReturn($article);

        m::mock('overload:App\Events\PublishNotificationEvent');

        $this->controller = new ArticleController($this->articleRepoMock);
        $response = $this->controller->changeStatus($id, $status);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('success', session()->all());
    }

    public function testChangeStatusFunctionFail()
    {
        $id = 1;
        $status = Article::NO_PUBLISH;

        $admin = m::mock(app()->make(User::class))->makePartial();
        $admin->is_admin = true;
        $admin->id = 9999;
        $this->actingAs($admin);

        $article = m::mock(app()->make(Article::class))->makePartial();
        $article->setRawAttributes([
            'id' => $id,
            'title' => 'Tieu de bai viet',
            'content' => 'Noi dung bai viet',
            'slug' => 'tieu-de-bai-viet',
        ]);

        $this->articleRepoMock->shouldReceive('getArticleAdmin')->with($id)->andReturn($article);
        $this->controller = new ArticleController($this->articleRepoMock);
        $response = $this->controller->changeStatus($id, $status);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('error', session()->all());
    }
}
