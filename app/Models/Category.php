<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function category()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('subCategories');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'articles_categories', 'category_id', 'article_id');
    }
}
