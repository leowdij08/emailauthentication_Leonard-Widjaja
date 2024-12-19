<?php

namespace Database\Seeders;

use App\Models\Journal;
use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    public function run(): void
    {
        $journals = [
            [
                'title' => 'Journal of Artificial Intelligence Research',
                'author' => 'Dr. Susan Carter',
                'publisher' => 'AI Research Society',
                'abstract' => 'A peer-reviewed journal covering advancements, applications, and ethical considerations in artificial intelligence.',
                'price' => 150000,
                'available_copies' => 10,
                'release_date' => '2024-02-15',
                'volume' => 12,
                'issue' => 3,
                'part' => 1,
                'access_url' => 'https://example.com/journal/ai-research',
            ],
            [
                'title' => 'Sustainability and Climate Change Journal',
                'author' => 'Dr. Jonathan Green',
                'publisher' => 'Earth Matters Press',
                'abstract' => 'A journal focused on global sustainability efforts, climate science, and renewable energy innovations.',
                'price' => 180000,
                'available_copies' => 12,
                'release_date' => '2023-11-01',
                'volume' => 22,
                'issue' => 5,
                'part' => 3,
                'access_url' => 'https://example.com/journal/sustainability-climate',
            ],
            [
                'title' => 'Global Economics and Policy Journal',
                'author' => 'Prof. Mark Taylor',
                'publisher' => 'Economics Press International',
                'abstract' => 'A journal examining economic policies, global markets, and emerging trends in financial systems.',
                'price' => 200000,
                'available_copies' => 8,
                'release_date' => '2024-01-10',
                'volume' => 30,
                'issue' => 4,
                'part' => 5,
                'access_url' => 'https://example.com/journal/global-economics',
            ],
            [
                'title' => 'Journal of Advanced Robotics',
                'author' => 'Dr. Alice Wang',
                'publisher' => 'TechFuture Publishing',
                'abstract' => 'An in-depth journal on robotics advancements, automation technologies, and real-world applications.',
                'price' => 160000,
                'available_copies' => 15,
                'release_date' => '2024-03-20',
                'volume' => 9,
                'issue' => 2,
                'part' => 7,
                'access_url' => 'https://example.com/journal/advanced-robotics',
            ],
            [
                'title' => 'Health and Wellness Journal',
                'author' => 'Dr. Clara Bennett',
                'publisher' => 'Wellness Publications',
                'abstract' => 'A journal promoting new research in health, nutrition, mental well-being, and fitness.',
                'price' => 140000,
                'available_copies' => 18,
                'release_date' => '2023-12-05',
                'volume' => 7,
                'issue' => 1,
                'part' => 8,
                'access_url' => 'https://example.com/journal/health-wellness',
            ],
        ];

        foreach ($journals as $journal) {
            Journal::create($journal);
        }
    }
}
