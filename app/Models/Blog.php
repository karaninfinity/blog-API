<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blogs";

    protected $fillable = [
        "id",
        "category_id",
        "subcategory_id",
        "title",
        "description",
        "content",
        "image",
        "created_at",
        "updated_at"
    ];

    public function category()
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }

    public function subcategory()
    {
        return $this->hasOne(Subcategory::class, "id", "subcategory_id");
    }
}
