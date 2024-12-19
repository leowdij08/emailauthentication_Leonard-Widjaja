<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar notifikasi yang akan dimasukkan ke dalam database
        $notifications = [
            [
                'title' => 'New Book Arrival: Meditations by Marcus Aurelius',
                'message' => 'The highly anticipated book "Meditations" by Marcus Aurelius is now available in our library. Come check it out!',
                'user_id' => 1, // ID pengguna yang akan menerima notifikasi
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Special Discount on Books and CDs',
                'message' => 'Enjoy a 20% discount on all books and CDs for a limited time. Visit our library to grab your favorites!',
                'user_id' => 2,
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'New CD Available: Abbey Road by The Beatles',
                'message' => 'The legendary album "Abbey Road" by The Beatles is now available in our collection. Get your copy today!',
                'user_id' => 3,
                'is_read' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Reminder: Return Your Library Books',
                'message' => 'Your library books are due for return soon. Please make sure to return them on time to avoid fines.',
                'user_id' => 4,
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'New Project Available: AI-Powered Agriculture',
                'message' => 'Check out the new final year project "AI-Powered Agriculture: Precision Farming System" in our library. Learn about the latest in AI and agriculture.',
                'user_id' => 5,
                'is_read' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Menambahkan setiap notifikasi ke dalam database
        foreach ($notifications as $notification) {
            Notification::create($notification);
        }
    }
}
