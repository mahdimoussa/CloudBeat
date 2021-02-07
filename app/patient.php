<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    protected $fillable = [
        'id', 'name', 'DOB','SST','SET','DID'
    ];
}
