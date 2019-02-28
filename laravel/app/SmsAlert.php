<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsAlert extends Model
{
    protected $fillable = ['phone', 'description'];

}
