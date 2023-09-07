<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    public function class()
    {
        return $this->belongsTo(StudentClass::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
