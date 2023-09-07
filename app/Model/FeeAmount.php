<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FeeAmount extends Model
{
    public function fee_category()
    {
        return $this->belongsTo(FeeCategory::class);
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class);
    }
}
