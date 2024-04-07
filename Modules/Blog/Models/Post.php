<?php

namespace Modules\Blog\Models;

use App\Models\Traits\HasUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Blog\Database\factories\PostFactory;

class Post extends Model
{
    use HasFactory;
    use HasUuid;

    protected $guarded = [];

    public $table = 'blog_posts';

    protected $casts = [
        'display_at' => 'datetime',
    ];

    public string $label = 'title';

    public string $section = 'Blog';

    public array $searchable = ['title'];

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }

    public function route($id): string
    {
        return route('admin.blog.posts.edit', ['post' => $id]);
    }

    public function author(): HasOne
    {
        return $this->hasOne(Author::class, 'id', 'author_id');
    }

    public function scopeDate($query)
    {
        return $query->where('display_at', '<=', Carbon::now());
    }

    public function scopeOrder($query)
    {
        return $query->orderBy('display_at', 'desc');
    }

    public function cats(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'blog_category_post');
    }
}
