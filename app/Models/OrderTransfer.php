<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Branch;
use App\Models\User;

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
    public function requestBranch() {
        return $this->belongsTo(Branch::class,'requested_branch_id', 'id');
    }
    public function approvedBranch() {
        return $this->belongsTo(Branch::class,'approved_branch_id', 'id');
    }
    public function requestUser() {
        return $this->belongsTo(User::class,'requested_user_id', 'id');
    }
    public function approvedUser() {
        return $this->belongsTo(User::class,'approved_user_id', 'id');
    }
}
