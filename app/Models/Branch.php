<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
class Branch extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'branches';

    protected $fillable = [
        'name',
        'location_id',
        'address',
    ];
    public function location() {
        return $this->belongsTo(Location::class);
    }

}
