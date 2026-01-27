<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pasangan',
        'email',
        'nomor_wa',
        'order_date',
        'status',
        'pacar_id',
    ];

    public function pacar()
    {
        return $this->belongsTo(Pacar::class);
    }
}
