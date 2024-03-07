<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStates extends Model
{
    use HasFactory;

    protected $table = 'order_status';
    protected $primaryKey = 'category_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable  = [
        'name'
    ];
}
