<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gallery_photos() {
        return $this->hasMany(Gallery::class)->orderByDesc('id')->limit(9);
    }

}
