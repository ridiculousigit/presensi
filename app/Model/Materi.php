<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id';
    protected $fillable = ['materi'];
}
