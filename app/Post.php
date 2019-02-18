<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Tag;
use App\User;
class Post extends Model
{
	protected $fillable = ['user_id','title','slug','image','body','status','is_approved'];
    public function categories(){
    	return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function tags(){
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function favarite_to_users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function comments(){
       return $this->hasMany('App\Comment');
    }
}
