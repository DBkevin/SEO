<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable=['name','description','meta_image'];

    //与文章表关联
    public function posts(){
        return $this->hasMany(Post::class,'category_id','id');
    }
}
