<?php

namespace App\Handlers;

use Overtrue\Pinyin\Pinyin;

class SlugHandler
{ 
    public function pinyin($text){
        return str_slug(app(Pinyin::class)->permalink($text));
    }
}
