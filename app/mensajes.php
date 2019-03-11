<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mensajes extends Model
{
    protected $table = 'mensajes';  
    
    //Relación de muchos a uno
    public function user(){
        return $this->belongsTo('App\User', 'id');
    }
}
