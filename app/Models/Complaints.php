<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'complaints';
    protected $fillable = ['summary', 'created_at', 'updated_at', 'description'];
}
