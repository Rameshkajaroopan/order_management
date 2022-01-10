<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Session;
use Closure;
use Illuminate\Http\Request;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $primaryKey = 'id';
    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'user_name',
        'role',
        'mobile',
        'password',
        'branch_id',
        'remember_token'
    ];
   
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
  
}
