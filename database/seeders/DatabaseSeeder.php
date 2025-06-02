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

        \App\Models\User::factory(2)->create();


        User::create ([
            'name'=>'Farhan Maulana',
            'email'=>'fm.farhanmaulana@gmail.com',
            'username'=>'walens',
            'password'=>bcrypt('12345')

        ]);

        User::create ([
            'name'=>'Harits Shiqdi',
            'email'=>'shidqi19@gmail.com',
            'username'=>'haritssq',
            'password'=>bcrypt('12345')

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
            'name'=>'Personal',
            'slug'=>'personal',
            
        ]);

        \App\Models\Post::factory(25)->create();


        // Post::create ([
        //     'title'=>'Keluh Kesah Programming -1',
        //     'slug'=>'post-pertama',
        //     'author'=>'Farhan Maulana',
        //     'excerpt'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
        //     'body'=>'<p>
        //             Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias placeat amet
        //             laboriosam distinctio error dignissimos quae perspiciatis consectetur
        //             accusantium ex suscipit dolores, minima vitae illum doloribus possimus
        //             beatae quos tenetur! Cupiditate fugiat animi itaque nulla fugit sint totam
        //             doloribus sit impedit. Eos fugit rerum numquam dicta, velit inventore vitae
        //             similique.
        //         </p>
        //         <p>
        //             Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis praesentium,
        //             sed ad, est minima eaque totam ea numquam eveniet consequuntur recusandae
        //             temporibus dolore saepe perspiciatis et aliquid vitae deserunt inventore
        //             dignissimos dolorum assumenda corrupti. Modi voluptatum et illum explicabo
        //             neque repudiandae itaque rerum provident dignissimos. In maxime, quia porro
        //             error neque exercitationem delectus officia dicta adipisci, quidem sint,
        //             amet quos sequi blanditiis numquam accusantium. Quaerat eos nemo a dolore
        //             ea!
        //         </p>',
        //     'category_id'=>1,
        //     'user_id'=>1
        // ]);

        // Post::create ([
        //     'title'=>'Keluh Kesah Bermain Dota -2',
        //     'slug'=>'post-kedua',
        //     'author'=>'Farhan Maulana',
        //     'excerpt'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
        //     'body'=>'<p>
        //             Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias placeat amet
        //             laboriosam distinctio error dignissimos quae perspiciatis consectetur
        //             accusantium ex suscipit dolores, minima vitae illum doloribus possimus
        //             beatae quos tenetur! Cupiditate fugiat animi itaque nulla fugit sint totam
        //             doloribus sit impedit. Eos fugit rerum numquam dicta, velit inventore vitae
        //             similique.
        //         </p>
        //         <p>
        //             Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis praesentium,
        //             sed ad, est minima eaque totam ea numquam eveniet consequuntur recusandae
        //             temporibus dolore saepe perspiciatis et aliquid vitae deserunt inventore
        //             dignissimos dolorum assumenda corrupti. Modi voluptatum et illum explicabo
        //             neque repudiandae itaque rerum provident dignissimos. In maxime, quia porro
        //             error neque exercitationem delectus officia dicta adipisci, quidem sint,
        //             amet quos sequi blanditiis numquam accusantium. Quaerat eos nemo a dolore
        //             ea!
        //         </p>',
        //     'category_id'=>3,
        //     'user_id'=>1
        // ]);

        // Post::create ([
        //     'title'=>'Programmer Tidak Sepuh -3',
        //     'slug'=>'post-ketiga',
        //     'author'=>'Farhan Maulana',
        //     'excerpt'=>'Lorem ipsum dolor, sit amet consectetur adipisicing elit.',
        //     'body'=>'<p>
        //             Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias placeat amet
        //             laboriosam distinctio error dignissimos quae perspiciatis consectetur
        //             accusantium ex suscipit dolores, minima vitae illum doloribus possimus
        //             beatae quos tenetur! Cupiditate fugiat animi itaque nulla fugit sint totam
        //             doloribus sit impedit. Eos fugit rerum numquam dicta, velit inventore vitae
        //             similique.
        //         </p>
        //         <p>
        //             Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis praesentium,
        //             sed ad, est minima eaque totam ea numquam eveniet consequuntur recusandae
        //             temporibus dolore saepe perspiciatis et aliquid vitae deserunt inventore
        //             dignissimos dolorum assumenda corrupti. Modi voluptatum et illum explicabo
        //             neque repudiandae itaque rerum provident dignissimos. In maxime, quia porro
        //             error neque exercitationem delectus officia dicta adipisci, quidem sint,
        //             amet quos sequi blanditiis numquam accusantium. Quaerat eos nemo a dolore
        //             ea!
        //         </p>',
        //     'category_id'=>1,
        //     'user_id'=>2
        // ]);
        
    }
}
