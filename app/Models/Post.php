<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use Sluggable,HasFactory; //auto ngambil table gapake ribet
    // protected $table = 'posts'; \ ->buat mendeklarasikan tabel mana yang dipilih dalam database

    // protected $fillable =['title','excerpt','body','author'];
    protected $guarded =['id'];
    protected $with =['category','user'];

    public function author_post(){
        return $this->belongsTo(User::class, 'user_id');

    }
    public function scopeFilter($query, array $filters){
        // if(isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('title','like','%' . $filters['search'] .'%')
        //             ->orWhere('body','like','%' . $filters['search'] .'%');
        //  }
            // dd($filters);
         $query->when($filters['search'] ?? false, function($query,$search) {
            return $query->where('title','like','%' . $search .'%')
            ->orWhere('body','like','%' . $search .'%');
         });

         $query->when($filters['category'] ?? false, function($query,$category){
            return $query->whereHas('category', function ($query) use($category) {
                $query->where('slug',$category);
            });
         });

         $query->when($filters['author'] ?? false, function($query,$author){
            return $query->whereHas('author_post', function ($query) use($author) {
                $query->where('name',$author);
            });
         });
    }

    public function Category() {
        return $this->belongsTo(Category::class);
    }

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
