<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sinhvien extends Model
{
    protected $table = 'sinhviens';

    public function diems()
    {
        return $this->hasMany('App\Models\Diem', 'sinhvien_id', 'id');
    }

    public function lops()
    {
        return $this->belongsTo('App\Models\Lop', 'lop_id', 'id');
    }
}
