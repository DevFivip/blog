<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
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


    public $timestamps = false;

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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232);
    }
}
