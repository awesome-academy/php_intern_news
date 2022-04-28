<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    protected $category;

    public function setUp(): void
    {
        parent::setUp();

        $this->category = new Category();
    }

    public function tearDown(): void
    {
        unset($this->category);

        parent::tearDown();
    }

    public function testTableAttribute()
    {
        $this->assertEquals('categories', $this->category->getTable());
    }

    public function testFillabelFiels()
    {
        $fields = ['name', 'slug', 'parent_id'];

        $this->assertEquals($fields, $this->category->getFillable());
    }

    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->category->getKeyName());
    }

    public function testCategoryRelationship()
    {
        $rel = $this->category->category();

        $this->assertInstanceOf(BelongsTo::class, $rel);
        $this->assertEquals('parent_id', $rel->getForeignKeyName());
        $this->assertEquals('id', $rel->getOwnerKeyName());
    }

    public function testSubCategoriesRelationship()
    {
        $rel = $this->category->subCategories();

        $this->assertInstanceOf(HasMany::class, $rel);
        $this->assertEquals('parent_id', $rel->getForeignKeyName());
        $this->assertEquals('id', $rel->getLocalKeyName());
    }

    public function testArticlesRelationship()
    {

        $rel = $this->category->articles();

        $this->assertInstanceOf(BelongsToMany::class, $rel);

        $this->assertEquals('articles_categories', $rel->getTable());
        $this->assertEquals('category_id', $rel->getForeignPivotKeyName());
        $this->assertEquals('article_id', $rel->getRelatedPivotKeyName());
    }
}
