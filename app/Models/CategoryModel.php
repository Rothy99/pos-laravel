<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'id',
        'cat_id',
        'cat_name',
        'description',
    ];
}
