<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherSms extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }
}
