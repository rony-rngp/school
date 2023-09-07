<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class);
    }

    public function discount_student()
    {
        return $this->belongsTo(DiscountStudent::class, 'id', 'assign_student_id');
    }
}
