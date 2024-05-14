<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    // protected $fillable = ['category_name','category_photo','slug'];

    use HasFactory;
    
    use SoftDeletes;

    protected $guarded = ['id'];

}
