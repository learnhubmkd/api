<?php

namespace App\Website\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogPostTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps = null;

    public function blogPosts(): BelongsToMany
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_tag_pivot', 'tag_id', 'blog_post_id');
    }
}
