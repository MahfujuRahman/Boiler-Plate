<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogWriters extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    
}
