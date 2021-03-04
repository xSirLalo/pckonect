<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Product::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$name = $this->faker->unique()->sentence();

		return [
			'name' => $name,
			'barcode' => $this->faker->randomNumber(5),
			'slug' => Str::slug($name),
			'description' => $this->faker->text(),
			'purchase_price' => $this->faker->randomNumber(2),
			'sale_price' => $this->faker->randomNumber(2),
			'stock' => $this->faker->randomNumber(2),
			'category_id' => Category::all()->random()->id,
		];
	}
}
