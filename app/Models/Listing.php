<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'image',
        'lost_found_date',
        'location',
        'contact_email',
        'contact_phone',
        'is_found',
        'is_claimed'
    ];
    protected $casts = [
        'lost_found_date' => 'datetime', 
    ];
    // Relationships
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function foundUser()
{
    return $this->belongsTo(\App\Models\User::class, 'found_by');
}

}