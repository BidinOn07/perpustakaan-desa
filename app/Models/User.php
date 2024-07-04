<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class User extends AuthenticatableUser implements Authenticatable
{
    use HasFactory, Notifiable;
    // protected $table = "users";
    protected $fillable = [
        'nama',
        'email',
        'password'
    ] ;

    // ...
}

// class User extends Model
// {

//     protected $guarded= ['id'] ;

// }
