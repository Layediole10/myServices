<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'budget',
        'content',
        'municipality',
        'district',
        'date_start',
        'date_end',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
