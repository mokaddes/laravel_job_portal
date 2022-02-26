<?php

if (!function_exists('format_date')) {
    function format_date($date): string
    {
        return date('d M, Y', strtotime($date));
    }
}
