<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pembelian extends Model
{
    use HasFactory;
    protected $fillable = ['id_detail','id_pembelian','id_menu','nama_menu','harga','jml_beli','subtotal'];
}
