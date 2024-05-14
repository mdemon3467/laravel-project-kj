<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    function rel_to_category(){ //jokhon onk thakbe tokhon hasmany hobe
      return  $this->belongsTo(category::class , 'category_id');
    }
    function rel_to_subcategory(){ //jokhon onk thakbe tokhon hasmany hobe
        return  $this->belongsTo(subcategory::class , 'subcategory_id');
      }
      function rel_to_brand(){ //jokhon onk thakbe tokhon hasmany hobe
        return  $this->belongsTo(Brand::class , 'brand_id');
      }
      function rel_to_inventory(){
        return $this->hasMany(inventory::class, 'product_id','id');
      }
}
