<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'detail_pesanan';

    protected $guarded = ['id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
    
    public function pesanan(){
        return $this->belongsTo(Pesanan::class, 'id_pesanan'); 
    }
    

}
