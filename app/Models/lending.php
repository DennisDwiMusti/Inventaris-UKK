<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lending extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'name',
        'total-item',
        'keterangan',
        'date',
        'return_date',
    ];
}
