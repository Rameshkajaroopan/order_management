<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'branches';

    protected $fillable = [
        'name',
        'location',
    ];
   

}
