<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Means extends Model
{
    protected $fillable = [
        'nickname','province','city','area','occupation','sex','birthday','height','education','monthly_income','marriage_history','introduce','ideal','wechat'
    ];

   public function photos(){
       return $this->hasMany(MeansPhoto::class);
   }
}
