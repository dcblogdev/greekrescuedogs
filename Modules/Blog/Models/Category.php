<?php

namespace Modules\Blog\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Blog\Database\factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;
    use HasUuid;

    protected $guarded = [];

    public $table = 'blog_categories';

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('title', 'asc');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'blog_category_post');
    }
}
