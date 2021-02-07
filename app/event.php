<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = [
        'id', 'type', 'BPM', 'date', 'PID'
    ];
}
