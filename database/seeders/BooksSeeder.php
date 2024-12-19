<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventory = [
            [
                'title' => 'Meditations',
                'author' => 'Marcus Aurelius',
                'publisher' => 'Penguin Classics',
                'description' => 'A series of personal writings by Marcus Aurelius on Stoic philosophy.',
                'published_date' => '180-01-01',
                'category' => 'philosophy',
                'price' => 80000,
                'stock' => 15,
                'purchase_link' => 'https://example.com/meditations',
            ],
            [
                'title' => 'The Adventures of Sherlock Holmes',
                'author' => 'Arthur Conan Doyle',
                'publisher' => 'George Newnes',
                'description' => 'A collection of twelve short stories featuring the detective Sherlock Holmes.',
                'published_date' => '1892-10-14',
                'category' => 'adventure',
                'price' => 120000,
                'stock' => 10,
                'purchase_link' => 'https://example.com/sherlock-holmes',
            ],
            [
                'title' => 'The Selfish Gene',
                'author' => 'Richard Dawkins',
                'publisher' => 'Oxford University Press',
                'description' => 'A popular science book on the evolution of life and gene-centered view of evolution.',
                'published_date' => '1976-03-13',
                'category' => 'science',
                'price' => 135000,
                'stock' => 12,
                'purchase_link' => null,
            ],
            [
                'title' => 'Guns, Germs, and Steel',
                'author' => 'Jared Diamond',
                'publisher' => 'W. W. Norton & Company',
                'description' => 'A study of the factors that influenced the development of civilizations.',
                'published_date' => '1997-03-01',
                'category' => 'history',
                'price' => 180000,
                'stock' => 8,
                'purchase_link' => 'https://example.com/guns-germs-steel',
            ],
            [
                'title' => 'Thinking, Fast and Slow',
                'author' => 'Daniel Kahneman',
                'publisher' => 'Farrar, Straus and Giroux',
                'description' => 'A groundbreaking book on behavioral psychology and decision-making processes.',
                'published_date' => '2011-10-25',
                'category' => 'psychology',
                'price' => 160000,
                'stock' => 10,
                'purchase_link' => 'https://example.com/thinking-fast-slow',
            ],
        ];

        foreach ($inventory as $item) {
            Books::create($item);
        }
    }
}
