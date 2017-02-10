# Madewithlove PHP-CS-Fixer configuration

The default [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) configuration for Madewithlove projects. 

## Installation

```bash
$ composer require madewithlove/php-cs-fixer-config
```

## Usage

**.php_cs**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::fromFolders(['src']);
```

You can also override rules per-project without overriding the core rules like this:

**.php_cs**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::fromFolders(['src'])->mergeRules([
   'php_unit_strict' => false,
]);
```
