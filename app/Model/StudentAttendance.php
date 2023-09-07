<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
