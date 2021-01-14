# WIP: Clify

Developing CLI applications in PHP.

## Installation

```bash
$ composer require chipslays/clify
```

## Usage

Place this code in `app` file:

```php
#!/usr/bin/env php
<?php 

use Clify\Cli;

require 'vendor/autoload.php';

$cli = new Cli;

print_r($cli->getArgs());
```

Run  `app` file in Terminal:
```bash
$ php app --data "hello world" --save "./path/to/file.txt" -o --append -val="test" --some="spaces here" lonely
```

Terminal output:
```php
Array
(
    [data] => hello world
    [save] => ./path/to/file.txt
    [o] => 1
    [append] => 1
    [val] => test
    [some] => spaces here
    [lonely] => 1
)
```

Terminal output (with new line):

```php
use Clify\Cli;

require 'vendor/autoload.php';

echo Cli::out("{blue}Blue text");
```

Colorize text output:

```php
use Clify\Cli;

require 'vendor/autoload.php';

echo Cli::colorize("{blue}Blue text{reset}");
echo Cli::colorize("{black}{bg:yellow} Black text on Yellow background{reset}");

// At the end, it will automatically add {reset}
echo Cli::colorizeLine("{blue}Blue text");
```

Available colors:

```php
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
```