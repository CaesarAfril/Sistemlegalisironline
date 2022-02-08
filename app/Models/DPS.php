<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DPS extends Model
{
    use HasFactory;
    protected $table = 'tb_progdi';
    protected $fillable = ['nama'];
}
