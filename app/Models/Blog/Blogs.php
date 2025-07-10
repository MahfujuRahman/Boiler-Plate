<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $guarded = [];

    use HasFactory;
    
    public function scopeActive($q) {
        return $q->where('status', 'active');
    }

    public function category() {
        return $this->belongsToMany(BlogsCategories::class);
    }

    public function tag() {
        return $this->belongsToMany(BlogTags::class, 'blog_blog_tag', 'blog_id', 'blog_tag_id');
    }

    public function writer() {
        return $this->belongsToMany(BlogWriters::class, 'blog_blog_writer', 'blog_id', 'blog_writer_id');
    }

}
