<?php

namespace Tests\Unit\Models;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;
use Mocker;
use Mockery;

use function PHPUnit\Framework\assertInstanceOf;

class ArticleTest extends TestCase
{

    const NO_PUBLISH = 1;
    const PENDING = 2;
    const APPROVED = 3;
    const REJECTED = 4;

    protected $article;

    public function setUp(): void
    {
        parent::setUp();

        $this->article = factory(Article::class)->make();
    }

    public function tearDown(): void
    {
        unset($this->article);
        parent::tearDown();
    }

    public function testTable()
    {
        $this->assertEquals('articles', $this->article->getTable());
    }

    public function testFillable()
    {
        $fields = [
            'cover_image',
            'title',
            'slug',
            'content',
            'author_id',
        ];

        $this->assertEquals($fields, $this->article->getFillable());
    }

    public function testStatusAttribute()
    {
        $this->article->setRawAttributes(['status' => static::NO_PUBLISH]);
        $this->assertEquals(static::NO_PUBLISH, $this->article->status);

        $this->article->setRawAttributes(['status' => static::PENDING]);
        $this->assertEquals(static::PENDING, $this->article->status);

        $this->article->setRawAttributes(['status' => static::APPROVED]);
        $this->assertEquals(static::APPROVED, $this->article->status);

        $this->article->setRawAttributes(['status' => static::REJECTED]);
        $this->assertEquals(static::REJECTED, $this->article->status);
    }

    public function testAuthorRelationship()
    {
        $rel = $this->article->author();

        $this->assertInstanceOf(BelongsTo::class, $rel);

        $this->assertEquals('author_id', $rel->getForeignKeyName());
        $this->assertEquals('id', $rel->getOwnerKeyName());
    }

    public function testApproverRelationship()
    {
        $rel = $this->article->approver();

        $this->assertInstanceOf(BelongsTo::class, $rel);

        $this->assertEquals('approved_by', $rel->getForeignKeyName());
        $this->assertEquals('id', $rel->getOwnerKeyName());
    }

    public function testCategoriesRelationship()
    {
        $rel = $this->article->categories();

        $this->assertInstanceOf(BelongsToMany::class, $rel);

        $this->assertEquals('articles_categories', $rel->getTable());
        $this->assertEquals('article_id', $rel->getForeignPivotKeyName());
        $this->assertEquals('category_id', $rel->getRelatedPivotKeyName());
    }

    public function testGetPublishStatusAttribute()
    {
        $this->article->published = static::NO_PUBLISH;
        $this->assertEquals(['style' => 'muted', 'string' => 'No publish'], $this->article->publish_status);

        $this->article->published = static::PENDING;
        $this->assertEquals(['style' => 'warning', 'string' => 'Pending'], $this->article->publish_status);

        $this->article->published = static::APPROVED;
        $this->assertEquals(['style' => 'success', 'string' => 'Publish'], $this->article->publish_status);

        $this->article->published = static::REJECTED;
        $this->assertEquals(['style' => 'danger', 'string' => 'Rejected'], $this->article->publish_status);
    }

    public function testGetExcerpAttribute()
    {
        $this->assertNull($this->article->excerp);
    }

    public function testHasCategoryFunction()
    {
        $this->assertIsBool($this->article->hasCategory(1));
    }

    public function testGetCategoriesStringFunction()
    {
        $this->assertIsString($this->article->getCategoriesString());
    }

    public function testExistImageFunction()
    {
        $this->assertIsBool($this->article->existImage());
    }

    public function testLocalScope()
    {
        assertInstanceOf(Builder::class, Article::publishing());
    }
}
