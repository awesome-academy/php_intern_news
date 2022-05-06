<?php

namespace App\Models;

use App\Scopes\UserStatusScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Article extends Model
{
    const NO_PUBLISH = 1;
    const PENDING = 2;
    const APPROVED = 3;
    const REJECTED = 4;

    protected $table = 'articles';
    protected $fillable = [
        'cover_image',
        'title',
        'slug',
        'content',
        'author_id',
    ];

    public function scopePublishing($query)
    {
        return $query->where('published', config('custom.article_status.approved'));
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id')
            ->withoutGlobalScope(UserStatusScope::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'articles_categories', 'article_id', 'category_id');
    }

    public function hasCategory($id)
    {
        return $this->categories->contains('id', $id);
    }

    public function getCategoriesString()
    {
        return $this->categories->implode('name', ', ');
    }

    public function getPublishStatusAttribute()
    {
        switch ($this->published) {
            case self::NO_PUBLISH:
                $status['style'] = 'muted';
                $status['string'] = __('No publish');
                break;
            case self::PENDING:
                $status['style'] = 'warning';
                $status['string'] = __('Pending');
                break;
            case self::APPROVED:
                $status['style'] = 'success';
                $status['string'] = __('Publish');
                break;
            default:
                $status['style'] = 'danger';
                $status['string'] = __('Rejected');
        }

        return $status;
    }

    public function existImage()
    {
        return Storage::disk('public')->exists($this->cover_image);
    }

    public function getExcerpAttribute()
    {
        //xử lý lấy đoạn trích của nội dung - later

        return null;
    }
}
