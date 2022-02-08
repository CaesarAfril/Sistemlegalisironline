<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRF extends Model
{
    use HasFactory;
    protected $table = 'tb_alumni';
    protected $fillable = ['nama_lengkap','NIM','program_studi','tahun_lulus','tracer_study','status','id_user'];
}
