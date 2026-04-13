<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division',
        'total-items',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
