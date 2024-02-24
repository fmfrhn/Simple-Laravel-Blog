<?php

namespace App\Models;

class PostModel 
{
    private static $blog_post = [
        [
           "judul" => "Post Pertama",
           "slug" => "post-pertama",
           "author" => "Farhan Maulana",
           "body" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos perspiciatis fuga quaerat veniam dolorum corporis, saepe esse? Sequi, accusamus! Quisquam dolorum cumque tenetur, ratione, nam, cum natus obcaecati quia sunt cupiditate commodi nobis? Laborum omnis blanditiis itaque optio voluptatibus sed asperiores doloribus autem natus. Ea esse voluptates officia quisquam aliquam illo officiis accusantium aperiam blanditiis delectus? Sit sunt quod maiores, enim nesciunt iste laudantium eligendi voluptates, voluptatem assumenda rerum autem. Debitis vitae quisquam fugit quibusdam quidem id voluptatum, veniam eius.
           "
        ],
        [
           "judul" => "Post Kedua",
           "slug" => "post-kedua",
           "author" => "Ojo Simatupang",
           "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem unde alias obcaecati optio aperiam, accusamus esse aut a numquam saepe ipsa facilis? Magnam earum quaerat facere ea adipisci enim cumque neque, sed cupiditate voluptates eveniet doloremque veritatis beatae labore culpa, ex nobis dolor quam! Totam quisquam modi, ad quis dolore, maxime vel quidem voluptatibus repellendus explicabo voluptas distinctio sed? Fuga eveniet aliquid hic laudantium alias. Fugiat aperiam minima, eius repellat inventore ea molestias nobis adipisci error voluptatibus, nostrum porro quaerat perferendis. Unde necessitatibus delectus corporis repudiandae in hic quisquam nesciunt fugit, maxime reiciendis blanditiis et adipisci. Placeat ducimus at id?"
        ],
     ];

     public static function all() {
        return collect(self::$blog_post); //bungkus dengan library collection
        // return self::$blog_posts;
    }

     public static function find( $slug ) {
        $posts = static::all();
        // $posts = self::$blog_post;
        // $post = [];
        // foreach($posts as $p) {
        //     if($p['slug'] === $slug ){
        //         $post = $p;
        //     }
        // } 

        return $posts->firstWhere('slug',$slug); //gunakan firstwhere untuk mengambil array 
        //ambil data yang pertama kali ditemukan dimana 'slug' nya sama dengan $slug
     }
}
