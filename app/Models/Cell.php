<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    protected $table = 'cell';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable  = [
        'shelve_id',
        'product_id',
        'position',
        'row',
        'occupied'
    ];

    protected $casts = [
        'is_occupied' => 'boolean',
    ];
}
