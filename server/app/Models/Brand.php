<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_name', 
        'brand_image', 
        'rating', 
        'country_code',
        'bonus',
        'terms',
        'link'
    ];}
