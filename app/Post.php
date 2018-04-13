<?php

namespace App;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Searchable;
    protected $fillable = ['user_id', 'content'];
    protected $with = ['user', 'likes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

}
