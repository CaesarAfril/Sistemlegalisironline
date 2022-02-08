<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_users extends Model
{
    use HasFactory;
    protected $table = ['tb_users'];
    protected $fillable = ['email','username','password','role'];
}
