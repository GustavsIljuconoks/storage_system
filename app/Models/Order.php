<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'order_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable  = [
        'status_id',
        'user_id',
        'manufacturer_id',
        'product_id',
        'product_count',
        'created-date',
        'shipment_date',
    ];
}
