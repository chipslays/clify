<?php

use Clify\Cli;

if (! function_exists('out')) {
    function out($text = '') {
        Cli::print($text);
    }
}

if (! function_exists('error')) {
    function error($text = '') {
        Cli::print('{light_red}' . $text);
    }
}

if (! function_exists('success')) {
    function success($text = '') {
        Cli::print('{light_green}' . $text);
    }
}

if (! function_exists('warning')) {
    function warning($text = '') {
        Cli::print('{yellow}' . $text);
    }
}

if (! function_exists('info')) {
    function info($text = '') {
        Cli::print('{light_cyan}' . $text);
    }
}


