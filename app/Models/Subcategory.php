<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $table="subcategories";
    protected $fillable = [
        "id",
        "subcategory",
        "subcategory_image",
        "category_id",
        "created_at",
        "updated_at"
    ];

    public function category()
    {
        return $this->belongsTo(category::class);    
    }
}

