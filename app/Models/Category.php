<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "Categories";
    protected $fillable = [
        "id",
        "category",
        "category_image",
        "status",
        "created_at",
        "updated_at"
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
