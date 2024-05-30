<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'recipes';
    //protected $guarded = false;
    protected $fillable = ['title', 'author_name', 'description', 'ingredients', 'category'];
}
