<?php

use Kirby\Cms\Page;
use Sociant\AckeeAnalytics\AckeeInstance;

if(!function_exists('ackeeInstance')) {    
    function ackeeInstance(Page $page) {
        return AckeeInstance::instance($page);
    }

}