<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLogs extends Model
{
    use HasFactory;

    protected $table = 'logs_order';
    protected $primaryKey = 'log_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable  = [
        'order_id',
        'action',
        'created_at',
        'updated_at',
    ];

    public function parent()
    {
        return $this->belongsTo(Order::class);
    }
}
