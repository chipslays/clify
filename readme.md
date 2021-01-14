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

Run our `app` file:
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

```php
use Clify\Cli;

require 'vendor/autoload.php';

echo Cli::colorize("{blue}Blue text{reset}");
echo Cli::colorize("{black}{bg:yellow} Black text on Yellow background{reset}");

// At the end, it will automatically add {reset}
echo Cli::colorizeLine("{blue}Blue text");
```

```php
use Clify\Cli;

require 'vendor/autoload.php';

echo Cli::out("{blue}Blue text");
```

