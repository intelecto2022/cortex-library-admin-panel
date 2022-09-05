<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'isbn', 'publisher_id', 'language_id', 'cover_id', 'script_id', 'format_id', 'total_pages', 'total_copies', 'published_at'
    ];

    // One to many relationships

    public function publisher()
    {
        return $this->belongsTo(Publishers::class, 'publisher_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function cover()
    {
        return $this->belongsTo(Cover::class, 'cover_id');
    }

    public function script()
    {
        return $this->belongsTo(Script::class, 'script_id');
    }

    public function format()
    {
        return $this->belongsTo(Format::class, 'format_id');
    }

    // Many to many relationships

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'category_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genres', 'genre_id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors', 'author_id');
    }
}
