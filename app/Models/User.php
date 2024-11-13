<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Use the Authenticatable class
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // Make sure it extends Authenticatable
{
    use Notifiable;

    // Define the fields that are mass assignable (to protect against mass-assignment vulnerabilities)
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Hide sensitive data such as the password when the model is converted to an array or JSON
    protected $hidden = [
        'password',
    ];
}
