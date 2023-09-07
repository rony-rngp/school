<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    public function class()
    {
        return $this->belongsTo(StudentClass::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
