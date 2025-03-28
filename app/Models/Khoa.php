<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    protected $table = 'khoas';

    public function monhocs()
    {
        return $this->hasMany('App\Models\Lop', 'khoa_id', 'id'); //khoa_id là khóa ngoại của bảng lops
    }
}
