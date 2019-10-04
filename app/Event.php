<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function campaings(){
        return $this->belongsToMany('App\Campaing');
    }
    public function vehicles(){
        return $this->belongsToMany('App\Vehicle');
    }
}
