<?php

namespace App\Http\Traits;

trait HelperTrait {

    public function replaceTags($input)
    {
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $input);
        return trim(preg_replace('#<marquee(.*?)>(.*?)</marquee>#is', '', $html));
    }

}