<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderTransfer;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'orders';

    protected $fillable = [
        'serial_number',
        'customer_name',
        'mobile',
        'Item',
        'weight',
        'mobile',
        'total_amount',
        'paid_amount',
        'payment_mode',
        'created_date',
        'due_date',
        'created_branch_id',
        'created_user_id',
        'address',
        'img',
        'working_status',
        'description',
        'current_location',

    ];

    public function OrderTransfers(){

        return $this->hasMany(OrderTransfer::class);
    }
    public function branch() {
        return $this->belongsTo(Branch::class,'created_branch_id', 'id');
    }
}
