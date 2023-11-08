<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model  implements Authenticatable
{
    use HasFactory;

    protected $fillable = [

        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Implement the required methods for the Authenticatable interface
    public function getAuthIdentifierName()
    {
        return 'id'; // or whatever the primary key of your model is
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null; // not needed for this example
    }

    public function setRememberToken($value)
    {
        // not needed for this example
    }

    public function getRememberTokenName()
    {
        return null; // not needed for this example
    }
}
