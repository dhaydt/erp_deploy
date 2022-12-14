<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipePembayaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nama_tipe',
    ];

    protected $appends = [
        'total_order'
    ];

    public function getTotalOrderAttribute(){
        return PreOrder::where('id_tipe_pembayaran', $this->id)->count();
    }

    public function preOrder(){
        return $this->hasMany(PreOrder::class, 'id_tipe_pembayaran');
    }
}
