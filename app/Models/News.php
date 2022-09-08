<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'name',
        'desc',
        'text',
        'photo'
    ];

    public function comments():HasMany {
        return $this->hasMany(Comment::class, 'news');
    }

    public function category():HasOne {
        return $this->hasOne(Category::class, 'id', 'category');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'tags_news', 'news', 'tag');
    }
}
