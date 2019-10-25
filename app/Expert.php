<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{

    protected $guarded=[];


    public function products(){


        return $this->belongsToMany(Product::class);

    }

}
