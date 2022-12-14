<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'region',
        'department',
        'municipality',
        'district',
        'occupation',
        'contact',
        'publish',
        'author_id',
        'category_id',
    ];


    public function author(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function isLikedByUser(){

        return $this->likes->where('user_id', auth()->user()->id)->isEmpty() ? false: true;
    }
}
