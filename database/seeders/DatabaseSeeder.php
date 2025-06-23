<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory(5)->create();


        User::create ([
            'name'=>'Farhan Maulana',
            'email'=>'fm.farhanmaulana@gmail.com',
            'username'=>'walens',
            'password'=>bcrypt('password'),
            'is_admin' => 1
        ]);

        User::create ([
            'name'=>'Harits Shiqdi',
            'email'=>'shidqi19@gmail.com',
            'username'=>'haritssq',
            'password'=>bcrypt('password')
        ]);

        Category::create ([
            'name'=>'Programming',
            'slug'=>'programming',
        ]);

        Category::create ([
            'name'=>'Web Design',
            'slug'=>'web-design',
        ]);
        Category::create ([
            'name'=>'Personal Story',
            'slug'=>'personal-story', 
        ]);
        Category::create ([
            'name'=>'Horror',
            'slug'=>'horror', 
        ]);
        Category::create ([
            'name'=>'Wisata Gunung',
            'slug'=>'wisata-gunung', 
        ]);

        \App\Models\Post::factory(100)->create();
        
    }
}
