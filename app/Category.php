<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = [];
//    protected $fillable = [
//         'id',
//         'title',
//
//    ];
//     protected $fillable=[];

//    public function setImageAttribute($value)
//    {
////        $this->attributes['image'] = 'admin/' . $value;
//
//    }


    public function products(){


        return $this->belongsToMany(Product::class);

    }

}
