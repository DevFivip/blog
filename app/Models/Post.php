<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'publish_date',
        'author_id',
        'category',
        'tags',
        'slug',
        'featured_image',
        'status',
        'views',
        // 'comments_count',
        'meta_description',
    ];

    // Relación con el modelo User (asumiendo que ya tienes un modelo User)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }
}
