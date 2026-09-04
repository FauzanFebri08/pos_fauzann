<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    
    protected $table = 'produk';
    protected $fillable = [
        'user_id',
        'foto',
        'nama',
        'jenis_id',
        'harga_beli',
        'harga_jual',
        'stok'
    ];
    public function user()
    {
    return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function jenis()
    {
    return $this->belongsTo(jenis::class, 'jenis_id', 'id');
    }
    public function itempenjualan()
    {
    return $this->hasMany(ItemPenjualan::class,'produk_id');
    }
}