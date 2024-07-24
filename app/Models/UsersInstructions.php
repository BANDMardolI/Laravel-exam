<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersInstructions extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'users_instructions';
    protected $fillable = ['summary', 'created_at', 'updated_at', 'imagepath'];
}

