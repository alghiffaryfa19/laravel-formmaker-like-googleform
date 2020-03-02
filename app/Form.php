<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table='table_form';
    protected $guarded= ['id'];

    public function Kategori()
    {
        return $this->belongsTo(\App\Category::class, 'categories_id','id');
    }
}
