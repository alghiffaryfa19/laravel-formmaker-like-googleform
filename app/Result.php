<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table='table_result';
    protected $guarded= ['id'];
    protected $casts = [
        'result' => 'array',
    ];
}
