<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pacar extends Model
{
    protected $fillable = [
        'nama',
        'usia',
        'alamat',
        'pekerjaan',
        'hobi',
        // Add other fields as needed
    ];
}
