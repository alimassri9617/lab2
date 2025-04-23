<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reviews extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'movie_id',
        'user_id',
        'title',
        'rating',
        'content',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function movie()
    {
        return $this->belongsTo(Movies::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
