<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table="subcategories";
    protected $fillable = [
        "id",
        "category",
        "subcategory_image",
        "category_id",
        "created_at",
        "updated_at"
    ];
    use HasFactory;
}
