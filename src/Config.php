<?php

declare(strict_types=1);

namespace Madewithlove\PhpCsFixer;

use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Finder;

class Config extends \PhpCsFixer\Config
{
    /**
     * The PHP version of the application.
     */
    protected string $target;

    /**
     * Create a new MWL configuration.
     *
     * Commented out lines are deprecated rules,
     * they're kept here for easier updates to the config
     * when PCF updates.
     */
    public function __construct(?string $target = null)
    {
        parent::__construct('madewithlove');

        $this->target = $target ?: PHP_VERSION;

        $this
            ->setRiskyAllowed(true)
            ->setRules([
                '@PSR12' => true,
                'array_syntax' => ['syntax' => 'short'],
                'cast_spaces' => true,
                'concat_space' => ['spacing' => 'one'],
                'declare_strict_types' => true,
                'modernize_types_casting' => true,
                'no_empty_comment' => true,
                'no_empty_phpdoc' => true,
                'no_superfluous_phpdoc_tags' => true,
                'no_trailing_comma_in_singleline_array' => true,
                'no_unused_imports' => true,
                'no_useless_return' => true,
                'no_whitespace_before_comma_in_array' => true,
                'object_operator_without_whitespace' => true,
                'phpdoc_no_useless_inheritdoc' => true,
                'phpdoc_var_without_name' => true,
                'php_unit_method_casing' => false,
                'protected_to_private' => true,
                'strict_param' => true,
                'single_quote' => true,
                'trailing_comma_in_multiline' => ['elements' => ['arrays']],
                'trim_array_spaces' => true,
                'whitespace_after_comma_in_array' => true,
            ]);
    }

    /**
     * @param string[] $folders
     * @param string[] $exclude folder to exclude
     */
    public static function fromFolders(array $folders, ?string $target = null, array $exclude = []): ConfigInterface
    {
        $config = new static($target);

        return $config->setFinder(
            Finder::create()->in($folders)->exclude($exclude)
        );
    }

    /**
     * @param string[] $folders
     */
    public static function forLaravel(array $folders = [], ?string $target = null): ConfigInterface
    {
        $folders = array_merge(['app', 'config', 'database', 'routes', 'tests'], $folders);

        return static::fromFolders($folders, $target);
    }

    /**
     * Merge a set of rules with the core ones.
     */
    public function mergeRules(array $rules): ConfigInterface
    {
        return $this->setRules(array_merge(
            $this->getRules(),
            $rules
        ));
    }

    public function enablePhpunitRules(): ConfigInterface
    {
        return $this->mergeRules([
            'php_unit_dedicate_assert' => true,
            'php_unit_dedicate_assert_internal_type' => true,
            'php_unit_expectation' => true,
            'php_unit_internal_class' => true,
            'php_unit_mock' => true,
            'php_unit_namespaced' => true,
            'php_unit_no_expectation_annotation' => true,
        ]);
    }
}
