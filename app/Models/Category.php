<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $fillable = [
      'name',
      'slug'
    ];
    public function Post(){
        return $this->hasMany(Post::class);
    }

}
