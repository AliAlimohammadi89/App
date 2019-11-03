<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded=[];


    public function Product(){


        return $this->belongsTo(Product::class);

    }

    public function Experts(){


        return $this->belongsTo(Expert::class);

    }

public function Customer(){


        return $this->belongsTo(Customer::class);

    }





}
