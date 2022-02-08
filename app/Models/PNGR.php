<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PNGR extends Model
{
    use HasFactory;
    protected $table = 'tb_pengiriman';
    protected $fillable = ['alamat','kode_pos','kota','provinsi','jumlah','ekspedisi','harga','resi','status','id_pemesan','id_berkas'];
}
