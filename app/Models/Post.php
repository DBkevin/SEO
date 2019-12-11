<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Form\Field\Tags;

class Post extends Model
{
    //允许批量赋值
    protected $fullable=[
        'title',
        'slug',
        'description',
        'meta_image',
        'body',
        'view_count',
        'praise_count',
    ];

    //与category的多对1关联
    public function Category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    
    public function tags(){
        return $this->belongsToMany(Tag::class,'posts_tag_pivot','posts_id','tags_id');
    }
   
}
