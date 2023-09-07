<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccountStudentFee extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
    public function year(){
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }
    public function class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
    public function fee_category(){
        return $this->belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }

}
