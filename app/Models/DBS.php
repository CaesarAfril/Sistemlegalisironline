<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DBS extends Model
{
    use HasFactory;
    protected $table = 'tb_berkas';
    protected $fillable = ['jenis_berkas','nomor_berkas','berkas','validator','id_user'];
}
