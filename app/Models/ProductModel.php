<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    protected $fillable = [
            'id',
            'pro_name',
            'pro_code',
            'category_id',
            'cur_stock',
            'price',
            'alert',
            'unit_id',
            'image',
    ];

}
