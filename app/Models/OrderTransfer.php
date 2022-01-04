<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderTransfer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'order_transfers';

    protected $fillable = [
        'order_id',
        'requested_branch_id',
        'approved_branch_id',
        'requested_user_id',
        'approved_user_id',
        'requested_date',
        'approved_date',
        'location_status',
        'request_status',
       
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
