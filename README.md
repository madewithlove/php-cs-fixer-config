# Madewithlove PHP-CS-Fixer configuration

## Installation

```bash
$ composer require madewithlove/php-cs-fixer-config
```

## Usage

**.php_cs
```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::create()->setFinder(
    PhpCsFixer\Finder::create()->in(['src'])
);
```