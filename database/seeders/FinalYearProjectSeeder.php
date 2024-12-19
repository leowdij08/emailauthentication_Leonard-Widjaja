<?php

namespace Database\Seeders;

use App\Models\FinalYearProject;
use Illuminate\Database\Seeder;

class FinalYearProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'AI-Powered Agriculture: Precision Farming System',
                'author' => 'Liam Peterson',
                'university' => 'AgriTech University',
                'abstract' => 'A precision farming system leveraging AI and IoT to monitor crop health, optimize irrigation, and improve yield efficiency.',
                'available_copies' => 5,
                'publication_date' => '2024-03-10',
                'project_url' => 'https://example.com/project/precision-farming-ai',
            ],
            [
                'title' => 'Blockchain for Supply Chain Transparency',
                'author' => 'Sophia Jackson',
                'university' => 'TechWorld University',
                'abstract' => 'A blockchain-based solution for ensuring transparency and traceability in supply chain operations.',
                'available_copies' => 7,
                'publication_date' => '2023-09-15',
                'project_url' => 'https://example.com/project/blockchain-supply-chain',
            ],
            [
                'title' => 'Smart Home Automation Using IoT',
                'author' => 'Ethan Brown',
                'university' => 'FutureTech Institute',
                'abstract' => 'A project focusing on creating a smart home ecosystem with IoT-enabled devices for energy efficiency and security.',
                'available_copies' => 4,
                'publication_date' => '2023-12-20',
                'project_url' => null,
            ],
            [
                'title' => 'Virtual Reality for Medical Training',
                'author' => 'Olivia Martinez',
                'university' => 'HealthTech University',
                'abstract' => 'Exploring the use of VR to simulate medical scenarios, enhancing the training experience for healthcare professionals.',
                'available_copies' => 6,
                'publication_date' => '2024-01-25',
                'project_url' => 'https://example.com/project/vr-medical-training',
            ],
            [
                'title' => 'Machine Learning for Financial Forecasting',
                'author' => 'Ava Wilson',
                'university' => 'DataScience Academy',
                'abstract' => 'A project using machine learning models to predict stock market trends and assist in financial decision-making.',
                'available_copies' => 8,
                'publication_date' => '2023-11-30',
                'project_url' => 'https://example.com/project/ml-financial-forecasting',
            ],
        ];

        foreach ($projects as $project) {
            FinalYearProject::create(array_merge($project, [
                'project_type' => 'final year project', 
            ]));
        }
    }
}
