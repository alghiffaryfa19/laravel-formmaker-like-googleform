<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table='table_category';
    protected $guarded= ['id'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }
    public function getRouteKeyName()
    {
        return 'nama_kategori';
    }
    public function Form()
    {
        return $this->hasMany(\App\Form::class, 'categories_id','id');
    }
}
