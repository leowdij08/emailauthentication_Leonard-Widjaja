<?php

namespace Database\Seeders;

use App\Models\Newspaper;
use Illuminate\Database\Seeder;

class NewspaperSeeder extends Seeder
{
    public function run(): void
    {
        $newspapers = [
            [
                'title' => 'Global News Today',
                'author' => 'Jessica Morgan',
                'publisher' => 'Global Media Corp.',
                'description' => 'A reliable daily newspaper providing the latest updates on international events, trade policies, and emerging trends.',
                'price' => 10000,
                'stock' => 150,
                'datePublished' => '2024-01-01',
                'onlineLink' => 'https://example.com/newspaper/global-news-today',
                'catalogue_type' => 'newspaper',
            ],
            [
                'title' => 'Tech Innovators Weekly',
                'author' => 'Alan Stevenson',
                'publisher' => 'NextGen Publications',
                'description' => 'A weekly publication showcasing breakthroughs in technology, AI research, and futuristic gadgets.',
                'price' => 12000,
                'stock' => 90,
                'datePublished' => '2023-12-15',
                'onlineLink' => 'https://example.com/newspaper/tech-innovators-weekly',
                'catalogue_type' => 'newspaper',
            ],
            [
                'title' => 'The Sustainability Digest',
                'author' => 'Rachel Williams',
                'publisher' => 'EcoAware Media',
                'description' => 'An essential resource for eco-conscious readers, featuring sustainable living tips, and environmental case studies.',
                'price' => 8000,
                'stock' => 120,
                'datePublished' => '2023-11-20',
                'onlineLink' => 'https://example.com/newspaper/sustainability-digest',
                'catalogue_type' => 'newspaper',
            ],
            [
                'title' => 'Art & Culture Review',
                'author' => 'Michael Carter',
                'publisher' => 'Creative Minds Press',
                'description' => 'A bi-weekly newspaper offering in-depth analyses of contemporary art, theater, and cultural events worldwide.',
                'price' => 7000,
                'stock' => 50,
                'datePublished' => '2023-12-01',
                'onlineLink' => 'https://example.com/newspaper/art-culture-review',
                'catalogue_type' => 'newspaper',
            ],
            [
                'title' => 'Sports Action Today',
                'author' => 'Oliver James',
                'publisher' => 'SportSphere Media',
                'description' => 'A daily sports-focused publication featuring match updates, player statistics, and expert analyses.',
                'price' => 6000,
                'stock' => 200,
                'datePublished' => '2024-01-15',
                'onlineLink' => 'https://example.com/newspaper/sports-action-today',
                'catalogue_type' => 'newspaper',
            ],
        ];

        foreach ($newspapers as $newspaper) {
            Newspaper::create($newspaper);
        }
    }
}
