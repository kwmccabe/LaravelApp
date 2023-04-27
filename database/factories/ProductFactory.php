<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 * @see https://fakerphp.github.io/formatters/
 *
 * $product = Product::factory()->make();
 * $product = Product::factory()->status()->make();
 * $product = Product::factory()->status('forthcoming')->make();
 */
class ProductFactory extends Factory
{
    private $status_options = ['active', 'forthcoming', 'out-of-stock', 'out-of-print', 'inactive'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status'        => fake()->randomElement($this->status_options),
            'slug'          => fake()->unique()->slug(),
            'isbn'          => fake()->unique()->isbn13(),
            'publish_date'  => fake()->date(),
            'pages'         => fake()->randomNumber(4, false),
            'title'         => ucwords(fake()->words(5, true)),
            'subtitle'      => fake()->sentence(),
            'description'   => fake()->paragraphs(3, true),
        ];
    }

    /**
     * Indicate that the model's status.
     */
    public function status($opt = 'active'): static
    {
        $opt = (in_array($opt,$this->status_options)) ? $opt : 'inactive';
        return $this->state(fn (array $attributes) => [
            'status' => $opt,
        ]);
    }


}
