<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Means extends Model
{
    protected $fillable = [
        'province','city','area','occupation','sex','birthday','height','education','monthly_income','marriage_history','introduce','ideal','wechat'
    ];
}
