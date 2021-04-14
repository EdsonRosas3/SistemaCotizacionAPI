<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDetail extends Model
{
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameUnidadGasto','aplicantName','requestDate', 'amount'
    ];

}
