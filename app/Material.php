<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['value'];

    public function products()
    {
      return $this->belongsToMany('App\Product');
    }
}
