<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['serial'];
    public function campaings(){
        return $this->belongsToMany('App\Campaing');
    }
}
