<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','parent_id','is_leaf'];
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function scopeWithoutChildren($query)
    {
        return $query->whereDoesntHave('children');
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
