<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monhoc extends Model
{
    protected $table = 'monhocs';

    public function lops()
    {
        return $this->belongsToMany('App\Models\Lop', 'monhoc_lop', 'monhoc_id', 'lop_id');
    }
    public function giangviens()
    {
        return $this->belongsTo('App\Models\Giangvien', 'giangvien_id', 'id');
    }
    public function diems()
    {
        return $this->hasMany('App\Models\Diem', 'monhoc_id', 'id');
    }
}
