<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "Blogs";

    protected $fillable = [
        "id",
        "category_id",
        "subcategory_id",
        "description",
        "image",
        "created_at",
        "updated_at"
    ];
}
