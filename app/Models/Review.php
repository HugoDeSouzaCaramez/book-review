<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review', 'rating'];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    protected static function booted()
    {
        //força a limpeza de cache quando alguma review do book é atualizada, deletada ou criada. Então mostra o dado mais atual no book.show
        static::updated(fn (Review $review) => cache()->forget('book:'.$review->book_id));
        static::deleted(fn (Review $review) => cache()->forget('book:'.$review->book_id));
        static::created(fn (Review $review) => cache()->forget('book:'.$review->book_id));
    }
}
