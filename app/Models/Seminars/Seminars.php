<?php

namespace App\Models\Seminars;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminars extends Model
{
    use HasFactory;

    public function participants() {
        return $this->hasMany(SeminarParticipants::class);
    }
}
