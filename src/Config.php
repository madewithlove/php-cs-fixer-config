<?php

namespace Madewithlove\PhpCsFixer;

use PhpCsFixer\Finder;

class Config extends \PhpCsFixer\Config
{
    /**
     * The PHP version of the application.
     *
     * @var string
     */
    protected $target;

    /**
     * An array of what version is required
     * for a each syntax fixer.
     *
     * @var array
     */
    protected $fixerPerVersion = [
        'class_keyword' => '5.5',
        'explicit_indirect_variable' => '7.0',
        'exponentiation' => '5.6',
        'null_coalescing' => '7.0',
        'short_array' => '5.4',
        'short_list' => '7.1',
        'void_return' => '7.1',
    ];

    /**
     * Create a new MWL configuration.
     *
     * @param string|null $target
     */
    public function __construct($target = null)
    {
        parent::__construct('madewithlove');

        $this->target = $target ?: PHP_VERSION;

        $this
            ->setRiskyAllowed(true)
            ->setRules([
                '@Symfony' => true,
                'align_multiline_comment' => true,
                'array_syntax' => $this->getSupportedSyntax('short_array'),
                'class_keyword_remove' => !$this->supports('class_keyword'),
                'combine_consecutive_issets' => true,
                'combine_consecutive_unsets' => true,
                'compact_nullable_typehint' => true,
                'declare_strict_types' => false,
                'doctrine_annotation_array_assignment' => true,
                'doctrine_annotation_braces' => true,
                'doctrine_annotation_indentation' => true,
                'doctrine_annotation_spaces' => true,
                'escape_implicit_backslashes' => true,
                'explicit_indirect_variable' => $this->supports('explicit_indirect_variable'),
                'explicit_string_variable' => true,
                'final_internal_class' => false,
                'general_phpdoc_annotation_remove' => false,
                'header_comment' => false,
                'heredoc_to_nowdoc' => false,
                'linebreak_after_opening_tag' => true,
                'list_syntax' => $this->getSupportedSyntax('short_list'),
                'mb_str_functions' => true,
                'method_chaining_indentation' => true,
                'native_function_invocation' => false,
                'no_blank_lines_before_namespace' => false,
                'no_multiline_whitespace_before_semicolons' => true,
                'no_null_property_initialization' => true,
                'no_php4_constructor' => true,
                'no_short_echo_tag' => false,
                'no_superfluous_elseif' => true,
                'no_unreachable_default_argument_value' => true,
                'no_useless_else' => true,
                'no_useless_return' => true,
                'not_operator_with_space' => false,
                'not_operator_with_successor_space' => false,
                'ordered_class_elements' => false,
                'ordered_imports' => true,
                'php_unit_expectation' => false,
                'php_unit_mock' => false,
                'php_unit_namespaced' => false,
                'php_unit_no_expectation_annotation' => false,
                'php_unit_strict' => false,
                'php_unit_test_annotation' => false,
                'php_unit_test_class_requires_covers' => false,
                'phpdoc_add_missing_param_annotation' => true,
                'phpdoc_order' => true,
                'phpdoc_types_order' => ['null_adjustment' => 'always_last'],
                'pow_to_exponentiation' => $this->supports('exponentiation'),
                'psr0' => true,
                'random_api_migration' => false,
                'simplified_null_return' => true,
                'static_lambda' => false,
                'strict_comparison' => true,
                'strict_param' => true,
                'ternary_to_null_coalescing' => $this->supports('null_coalescing'),
                'void_return' => $this->supports('void_return'),
            ]);
    }

    /**
     * @param string|string[] $folders
     * @param string|null     $target
     *
     * @return $this
     */
    public static function fromFolders($folders, $target = null)
    {
        $config = new static($target);

        return $config->setFinder(
            Finder::create()->in($folders)
        );
    }

    /**
     * @param string|string[] $folders
     * @param string|null     $target
     *
     * @return $this
     */
    public static function forLaravel($folders = [], $target = null)
    {
        $folders = (array) $folders;
        $folders = array_merge(['app', 'config', 'database', 'routes', 'tests'], $folders);

        return static::fromFolders($folders, $target);
    }

    /**
     * Merge a set of rules with the core ones.
     *
     * @param array $rules
     *
     * @return $this
     */
    public function mergeRules(array $rules)
    {
        return $this->setRules(array_merge(
            $this->getRules(),
            $rules
        ));
    }

    ////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////// HELPERS ////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////

    /**
     * @param string $fixer
     *
     * @return array
     */
    protected function getSupportedSyntax($fixer)
    {
        $syntax = $this->supports($fixer) ? 'short' : 'long';

        return compact('syntax');
    }

    /**
     * @param string $fixer
     *
     * @return bool
     */
    protected function supports($fixer)
    {
        if (!isset($this->fixerPerVersion[$fixer])) {
            return true;
        }

        return version_compare($this->target, $this->fixerPerVersion[$fixer]) !== -1;
    }
}
