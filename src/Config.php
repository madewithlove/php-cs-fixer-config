<?php

declare(strict_types=1);

namespace Madewithlove\PhpCsFixer;

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
                'strict_param' => true,
                'array_syntax' => ['syntax' => 'short'],
                'php_unit_method_casing' => false,
                'trailing_comma_in_multiline' => ['elements' => ['arrays']],
                'no_trailing_comma_in_singleline_array' => true,
                'no_unused_imports' => true,
                'concat_space' => ['spacing' => 'one'],
                'modernize_types_casting' => true,
                'no_superfluous_phpdoc_tags' => true,
                'phpdoc_no_useless_inheritdoc' => true,
                'phpdoc_var_without_name' => true,
                'protected_to_private' => true,
                'single_quote' => true,
                'no_empty_comment' => true,
                'no_empty_phpdoc' => true,
                'declare_strict_types' => true,
            ]);
    }

    /**
     * @param string[] $folders
     * @param string[] $exclude folder to exclude
     */
    public static function fromFolders(array $folders, ?string $target = null, array $exclude = []): self
    {
        $config = new static($target);

        return $config->setFinder(
            Finder::create()->in($folders)->exclude($exclude)
        );
    }

    /**
     * @param string[] $folders
     */
    public static function forLaravel(array $folders = [], ?string $target = null): self
    {
        $folders = (array) $folders;
        $folders = array_merge(['app', 'config', 'database', 'routes', 'tests'], $folders);

        return static::fromFolders($folders, $target);
    }

    /**
     * Merge a set of rules with the core ones.
     */
    public function mergeRules(array $rules): self
    {
        return $this->setRules(array_merge(
            $this->getRules(),
            $rules
        ));
    }

    public function enablePhpunitRules(): self
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
