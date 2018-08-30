<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    protected $table = 'user_product_assoc';
    protected $guarded = ['created_at', 'updated_at'];
}
