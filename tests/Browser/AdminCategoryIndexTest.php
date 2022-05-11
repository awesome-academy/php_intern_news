<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminCategoryIndexTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCheckNotLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('admin.categories.index')
                ->assertPathIs('/');
        });
    }

    public function testCheckDisplayUI()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->assertSee(__('Category management'))
                ->assertSee(Str::upper(__('Name')))
                ->assertSee(Str::upper(__('Slug')))
                ->assertSee(Str::upper(__('Parent')))
                ->assertSee(Str::upper(__('Options')));
        });
    }

    public function testClickSaveButton()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->click('#btn-save')
                ->pause(1000)
                ->assertSee(__('The name field is required'));
        });
    }

    public function testClickEditButton()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $category = Category::orderBy('created_at', 'desc')->first();
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->click('#btn-edit-' . $category->id)
                ->waitForRoute('admin.categories.edit', $category->id)
                ->assertRouteIs('admin.categories.edit', $category->id);
        });
    }

    public function testClickDeleteButton()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $category = Category::create([
                'name' => 'Test Category',
                'slug' => 'test-category',
                'parent_id' => 0,
            ]);
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->click('#btn-delete-' . $category->id)
                ->pause(1000)
                ->assertSee(__('Deleted successfully!'));
        });
    }

    public function testClickLogoutButton()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $category = Category::orderBy('created_at', 'desc')->first();
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->click('#btn-logout')
                ->assertPathIs('/');
        });
    }

    public function testClickBackToNewsSiteButton()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $category = Category::orderBy('created_at', 'desc')->first();
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->click('#btn-news-site')
                ->assertPathIs('/');
        });
    }

    public function testClickDashboardLink()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->click('#l-dashboard')
                ->assertRouteIs('admin.index');
        });
    }

    public function testClickArticlesLink()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->click('#l-article')
                ->assertRouteIs('admin.articles.index');
        });
    }

    public function testClickWritersLink()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->click('#l-writer')
                ->assertRouteIs('admin.users.index');
        });
    }

    public function testClickCategoriesLink()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->loginAs($user)
                ->visitRoute('admin.categories.index')
                ->assertPathIs('/admin/categories')
                ->click('#l-category')
                ->assertRouteIs('admin.categories.index');
        });
    }
}
