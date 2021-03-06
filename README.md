# Madewithlove PHP-CS-Fixer configuration

The default [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) configuration for Madewithlove projects. 

## Installation

```bash
$ composer require madewithlove/php-cs-fixer-config
```

## Usage

### Basic usage

**.php-cs-fixer.php**

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

**.php-cs-fixer.php**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::fromFolders(['src'])->mergeRules([
   'php_unit_strict' => false,
]);
```

### Usage within a Laravel project

You can also preconfigure the configuration for a Laravel project by calling a special factory method:

**.php-cs-fixer.php**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::forLaravel();
```

If need be, you can also append folders to fix in addition to Laravel's:

**.php-cs-fixer.php**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::forLaravel(['some_other_folder']);
```

### Targeting a specific PHP version

By default, the configuration will check the version of PHP you run the tool with, and proceed to enable/disable fixers depending on it. 

You can override the _target_ PHP version by passing it either as constructor argument, or as second argument to `fromFolders`:

**.php-cs-fixer.php**

```php
<?php
require 'vendor/autoload.php';

return Madewithlove\PhpCsFixer\Config::fromFolders(['src'], '7.4');

// Or
return Madewithlove\PhpCsFixer\Config::forLaravel([], '7.4');
```
