<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'author' => $faker->name,
        'isbn' => $faker->ean13,
        'publisher' => $faker->company,
        'quantity' => $faker->numberBetween($min = 1, $max = 5),
        'image' => 'book_images/book.jpeg'
    ];
});
