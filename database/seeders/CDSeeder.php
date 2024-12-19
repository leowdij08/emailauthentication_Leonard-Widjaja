<?php

namespace Database\Seeders;

use App\Models\CD;
use Illuminate\Database\Seeder;

class CDSeeder extends Seeder
{
    public function run(): void
    {
        $cds = [
            [
                'title' => 'Abbey Road',
                'author' => 'The Beatles',
                'publisher' => 'Apple Records',
                'description' => 'The iconic album from The Beatles featuring classics like "Come Together" and "Here Comes the Sun".',
                'price' => 250000,
                'stock' => 15,
                'datePublished' => '1969-09-26',
                'genre' => 'rock',
                'onlineLink' => 'https://example.com/abbey-road',
                'catalogue_type' => 'CD',
            ],
            [
                'title' => 'Rumours',
                'author' => 'Fleetwood Mac',
                'publisher' => 'Warner Bros. Records',
                'description' => 'One of the best-selling albums of all time, featuring timeless tracks like "Go Your Own Way" and "Dreams".',
                'price' => 220000,
                'stock' => 10,
                'datePublished' => '1977-02-04',
                'genre' => 'rock',
                'onlineLink' => 'https://example.com/rumours',
                'catalogue_type' => 'CD',
            ],
            [
                'title' => 'Kind of Blue',
                'author' => 'Miles Davis',
                'publisher' => 'Columbia Records',
                'description' => 'A masterpiece of jazz, regarded as one of the greatest albums of all time, featuring Miles Davis and John Coltrane.',
                'price' => 180000,
                'stock' => 20,
                'datePublished' => '1959-08-17',
                'genre' => 'jazz',
                'onlineLink' => 'https://example.com/kind-of-blue',
                'catalogue_type' => 'CD',
            ],
            [
                'title' => '25',
                'author' => 'Adele',
                'publisher' => 'XL Recordings',
                'description' => 'Adele\'s record-breaking album, featuring chart-topping hits like "Hello" and "When We Were Young".',
                'price' => 200000,
                'stock' => 18,
                'datePublished' => '2015-11-20',
                'genre' => 'pop',
                'onlineLink' => 'https://example.com/25',
                'catalogue_type' => 'CD',
            ],
            [
                'title' => 'Thriller',
                'author' => 'Michael Jackson',
                'publisher' => 'Epic Records',
                'description' => 'The best-selling album of all time, featuring hits like "Billie Jean", "Beat It", and "Thriller".',
                'price' => 300000,
                'stock' => 25,
                'datePublished' => '1982-11-30',
                'genre' => 'pop',
                'onlineLink' => 'https://example.com/thriller',
                'catalogue_type' => 'CD',
            ],
        ];

        foreach ($cds as $cd) {
            CD::create($cd);
        }
    }
}
