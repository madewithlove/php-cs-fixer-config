# Madewithlove PHP-CS-Fixer configuration

The default [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) configuration for Madewithlove projects. 

## Installation

```bash
$ composer require madewithlove/php-cs-fixer-config
```

## Usage

### Basic usage

**.php_cs**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::fromFolders(['src']);
```

To exclude a subfolder:

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::fromFolders(['src'], null, ['ignoreThisDir']);
```
This will skip `src/ignoreThisDir` or `src/foo/bar/ignoreThisDir`. (_The folder has to be relative to the ones in the first argument._)

You can also override rules per-project without overriding the core rules like this:

**.php_cs**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::fromFolders(['src'])->mergeRules([
   'php_unit_strict' => false,
]);
```

### Usage within a Laravel project

You can also preconfigure the configuration for a Laravel project by calling a special factory method:

**.php_cs**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::forLaravel();
```

If need be, you can also append folders to fix in addition to Laravel's:

**.php_cs**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::forLaravel(['some_other_folder']);
```

### Targeting a specific PHP version

By default the configuration will check the version of PHP you run the tool with, and proceed to enable/disable fixers depending on it. 
Per example if you're using a version of PHP that supports short arrays, it will convert them all to it. Whereas if you're using PHP 5.3 it will convert them to long arrays.

You can override the _target_ PHP version by passing it either as constructor argument, or as second argument to `fromFolders`:

**.php_cs**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::fromFolders(['src'], '7.0.4');

// Or
return Madewithlove\PhpCsFixer\Config::forLaravel([], '7.0.4');
```
