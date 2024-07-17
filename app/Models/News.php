<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'instructions';
    protected $fillable = ['summary', 'short_description', 'full_text', 'created_at', 'updated_at', 'imagepath'];
}
