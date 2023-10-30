<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name']; // Add other fields as needed

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
