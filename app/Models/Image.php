<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'original_name',
        'session_index',
        'article_id',
    ];

    public function article(){
        return $this->belongsTo(Article::class);
    }
}