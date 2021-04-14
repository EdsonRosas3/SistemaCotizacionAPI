<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RequestDetail; 
use App\Report; 

class RequestQuotitation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameUnidadGasto','aplicantName','requestDate','details','amount',
    ];

    public function requestDetails(){
        return $this->hasMany(RequestDetail::class);
    }
    public function reports(){
        return $this->hasMany(Report::class);
    }

}
