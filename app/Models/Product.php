<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
      function rel_to_tags(){
        return $this->hasMany(Tag::class, 'tags', 'id');
      }
      function rel_to_gallery(){
        return $this->hasMany(Gallery::class);
      }
}
