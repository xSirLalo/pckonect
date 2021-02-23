<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CyberControl extends Model
{
    use HasFactory;

    protected $table = 'cybercontrols';

    protected $fillable = ['user_id', 'computer_id', 'status'];

    // Relacion uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}

