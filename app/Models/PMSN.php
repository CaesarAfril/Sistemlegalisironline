<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMSN extends Model
{
    use HasFactory;
    protected $table = 'tb_pemesanan';
    protected $fillable = ['pengiriman','id_berkas'];
}
