<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = ['jurusan', 'fakultas', 'tingkat', 'nama_kelas'
        ];
}
