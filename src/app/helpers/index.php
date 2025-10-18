<?php

use Core\Uri;

if (!function_exists('base_url')) {
    function base_url($path = '')
    {
        return Uri::base($path);
    }
}
