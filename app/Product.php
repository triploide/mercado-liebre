<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'description', 'price', 'category_id', 'slug', 'user_id'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //relaciones
    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function images()
    {
      return $this->hasMany('App\Image');
    }

    public function materials()
    {
      return $this->belongsToMany('App\Material');
    }

    //scopes
    public function scopeVisibles($query)
    {
      $query->where('visible', 1);
    }
}
