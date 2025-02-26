<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email',
        'first_name',
        'last_name',
        'shipping_address',
        'phone',
        'payment_method',
        'total_amount',
        'vat',
        'discount_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'total_amount' => 'decimal:2',
        'vat' => 'decimal:2',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the discount for the order.
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_code', 'code');
    }
}
