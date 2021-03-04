<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	// Relacion uno a muchos inversa
	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	// Relacion uno a uno polimorfica
	public function image()
	{
		return $this->morphOne(Image::class, 'imageable');
	}
}
