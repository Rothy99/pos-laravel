<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificationModel extends Model
{
    protected $table = 'specification';

    protected $fillable = [
        'id',
        'specification_id',
        'pro_id',
        'specification_name',
        'specification_value',
        'price',

    ];
}
