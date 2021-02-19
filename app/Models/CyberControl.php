<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CyberControl extends Model
{
    use HasFactory;

    protected $table = 'cybercontrols';

    protected $fillable = ['user_id', 'number_computer', 'status'];
}
