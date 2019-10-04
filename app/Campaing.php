<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaing extends Model
{
    protected $fillable = ['name','code'];
    public function events(){
        return $this->belongsToMany('App\Event');
    }

    public function vehicles(){
        return $this->belongsToMany('App\Vehicle');
    }
}
