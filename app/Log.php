<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table='logs';
    
    public function user()
    {
        //EstemétododevuelveelobjetoUsuarioquehahechoelLike
        return $this->belongsTo('App\User','id');
    }
}
