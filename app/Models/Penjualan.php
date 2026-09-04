<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Penjualan extends Model
{
    use HasFactory;
    
    protected $table = 'penjualan';

    protected $fillable = [
        'user_id',
        'total_pembayaran',
        'metode_pembayaran',
        'status',
    ];
    public function itempenjualan()
    {
    return $this->hasMany(ItemPenjualan::class,'penjualan_id');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}


}
