<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'title'
    ];

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function demandes(){
        return $this->hasMany(Demande::class);
    }
}
