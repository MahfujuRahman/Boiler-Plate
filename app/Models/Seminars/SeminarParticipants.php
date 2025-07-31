<?php

namespace App\Models\Seminars;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarParticipants extends Model
{
    use HasFactory;

    public function seminars() {
        return $this->hasMany(SeminarParticipants::class, 'seminar_id');
    }
}
