<?php

namespace Clify;

use Chipslays\Collection\Collection;

class Cli
{
    private $args = [];
    private static $nextArgumentShouldBeValue = false;
    private static $prevArrayKey = null; 

    public function __construct(array $arguments = null) 
    {
        $this->args = new Collection(self::parse($arguments));
    }

    /**
     * Get array with parsed args.
     *
     * @return array
     */
    public function getArgs() 
    {
        return $this->args;
    }

    public function get($key, $default = null) 
    {
        return $this->args->get($key, $default);
    }

    /**
     * Parse aguments to array.
     *
     * @param array $arguments
     * @return array
     */
    public static function parse(array $arguments = null) {
        // TODO должен быть парс из массива $argv или из строки
        $args = is_array($arguments) ? $arguments : (is_null($arguments) ? $_SERVER['argv'] : explode(' ', $arguments));
    
        if (!is_array($arguments)) {
            unset($args[0]);
        }

        $result = [];

        foreach ($args as $arg) {
            // FIXME придумать что делать с кавычками если данные передаются из обычного массива/строки
            $arg = str_replace(['"', '"'], '', $arg);

            if (self::isArgument($arg)) {
                self::$nextArgumentShouldBeValue = false;
                self::$prevArrayKey = null;
    
                $countOfMinus = substr_count(mb_substr($arg, 0, 2), '-');
                if ($countOfMinus == 1) {
                    [$key, $value] = self::parseArgument($arg);
                    $result[$key] = $value;
                } elseif ($countOfMinus == 2) {
                    [$key, $value] = self::parseArgument($arg);
                    $result[$key] = $value;
                } else {
                    $result[$arg] = true;
                }
            } else {
                if (self::$nextArgumentShouldBeValue) {
                    $result[self::$prevArrayKey] = $arg;
                    self::$nextArgumentShouldBeValue = false;
                    self::$prevArrayKey = null;
                } else {
                    $result[$arg] = true;
                }
            }
        }

        self::$nextArgumentShouldBeValue = false;
        self::$prevArrayKey = null;
            
        return $result;
    }
    
    /**
     * Check chunk of string for argument.
     *
     * @param string|int $str
     * @return boolean
     */
    public static function isArgument($str) {
        return mb_substr($str, 0, 1) == '-';
    }

    /**
     * Print text with auto new-line.
     *
     * @param string|int $text
     * @return void
     */
    public static function print($text = '')
    {
        echo self::colorizeLine($text) . PHP_EOL;
    }

    /**
     * Ask and get answer.
     * 
     * @param string|int $text,
     * @param array $variants
     * @return string
     */
    public static function ask($text, $variants = ['Y', 'n']) 
    {
        echo self::colorizeLine($text . ' {yellow}[' . implode('/', $variants) . ']{reset}: ');
        return rtrim(fgets(STDIN), "\n");
    }

    /**
     * Colorize text and reset on end.
     *
     * @param string|int $text
     * @return string
     */
    public static function colorizeLine($text = '') {
        return self::colorize($text . '{reset}');
    }

    /**
     * Colorize text.
     *
     * @param string|int $text
     * @return void
     */
    public static function colorize($text = '')
    {
        $list = [
            "{reset}" => "\e[0m",
            "{black}" => "\e[0;30m",
            "{white}" => "\e[1;37m",
            "{dark_grey}" => "\e[1;30m",
            "{dark_gray}" => "\e[1;30m",
            "{light_grey}" => "\e[0;37m",
            "{light_gray}" => "\e[0;37m",
            "{red}" => "\e[0;31m",
            "{light_red}" => "\e[1;31m",
            "{green}" => "\e[0;32m",
            "{light_green}" => "\e[1;32m",
            "{brown}" => "\e[0;33m",
            "{yellow}" => "\e[1;33m",
            "{blue}" => "\e[0;34m",
            "{magenta}" => "\e[0;35m",
            "{light_magenta}" => "\e[1;35m",
            "{cyan}" => "\e[0;36m",
            "{light_cyan}" => "\e[1;36m",
            "{bg:black}" => "\e[40m",
            "{bg:red}" => "\e[41m",
            "{bg:green}" => "\e[42m",
            "{bg:yellow}" => "\e[43m",
            "{bg:blue}" => "\e[44m",
            "{bg:magenta}" => "\e[45m",
            "{bg:cyan}" => "\e[46m",
            "{bg:light_grey}" => "\e[47m",
            "{bg:light_gray}" => "\e[47m",
        ];

        return strtr($text, $list);
    }

    /**
     * Parse string with arguments.
     *
     * @param string $arg
     * @return array
     */
    public static function parseArgument($arg)
    {
        $key = ltrim($arg, '-');
        $value = true;
        self::$nextArgumentShouldBeValue = strpos($key, '=') === false;

        if (!self::$nextArgumentShouldBeValue) {
            preg_match('/^(.*?)=/', $key, $matches);
            $key = $matches[1] ?? null;
            preg_match('/=(.*?)$/', ltrim($arg, '-'), $matches);
            $value = $matches[1] ?? null;
        } else {
            self::$prevArrayKey = $key; // надо для если nextArgumentShouldBeValue == true
        }

        return [
            $key,
            $value,
        ];
    }
}