<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SectionCustomer extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;


    protected $fillable = [
        "position",
        "title",
        "content",
        "label",
        "action_button_title",
        "action_button_link",
        "secondary_button_title",
        "secondary_button_link",
    ];

        
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232);
    }


}
