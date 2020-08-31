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
        'short_array' => '5.4',
        'class_keyword' => '5.5',
        'exponentiation' => '5.6',
        'dirname_level' => '7.0',
        'explicit_indirect_variable' => '7.0',
        'null_coalescing' => '7.0',
        'type_annotations' => '7.0',
        'short_list' => '7.1',
        'void_return' => '7.1',
        'heredoc_indentation' => '7.3',
    ];

    /**
     * Create a new MWL configuration.
     *
     * Commented out lines are deprecated rules,
     * they're kept here for easier updates to the config
     * when PCF updates.
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
                'array_indentation' => true,
                'array_syntax' => $this->getSupportedSyntax('short_array'),
                'backtick_to_shell_exec' => true,
                // 'blank_line_before_return' => true,
                'class_keyword_remove' => !$this->supports('class_keyword'),
                'combine_consecutive_issets' => true,
                'combine_consecutive_unsets' => true,
                'combine_nested_dirname' => $this->supports('dirname_level'),
                'comment_to_phpdoc' => true,
                'compact_nullable_typehint' => true,
                'date_time_immutable' => false,
                'declare_strict_types' => false,
                'doctrine_annotation_array_assignment' => true,
                'doctrine_annotation_braces' => true,
                'doctrine_annotation_indentation' => true,
                'doctrine_annotation_spaces' => true,
                'escape_implicit_backslashes' => true,
                'explicit_indirect_variable' => $this->supports('explicit_indirect_variable'),
                'explicit_string_variable' => true,
                'final_class' => false,
                'final_internal_class' => false,
                'final_public_method_for_abstract_class' => false,
                'final_static_access' => true,
                'fully_qualified_strict_types' => true,
                'general_phpdoc_annotation_remove' => false,
                'global_namespace_import' => true,
                // 'hash_to_slash_comment' => true,
                'header_comment' => false,
                'heredoc_indentation' => $this->supports('heredoc_indentation'),
                'heredoc_to_nowdoc' => false,
                'linebreak_after_opening_tag' => true,
                'list_syntax' => $this->getSupportedSyntax('short_list'),
                'logical_operators' => true,
                // 'lowercase_constants' => true,
                'mb_str_functions' => true,
                'method_chaining_indentation' => true,
                // 'method_separation' => true,
                'multiline_comment_opening_closing' => true,
                'multiline_whitespace_before_semicolons' => true,
                'no_alternative_syntax' => true,
                'no_binary_string' => true,
                'no_blank_lines_before_namespace' => false,
                // 'no_extra_consecutive_blank_lines' => true,
                // 'no_multiline_whitespace_before_semicolons' => true,
                'no_null_property_initialization' => true,
                'no_php4_constructor' => true,
                'no_short_echo_tag' => false,
                'no_superfluous_elseif' => true,
                'no_unreachable_default_argument_value' => true,
                'no_unset_cast' => true,
                'no_unset_on_property' => true,
                'no_useless_else' => true,
                'no_useless_return' => true,
                'not_operator_with_space' => false,
                'not_operator_with_successor_space' => false,
                'nullable_type_declaration_for_default_null_value' => true,
                'ordered_class_elements' => false,
                'ordered_interfaces' => true,
                'php_unit_dedicate_assert' => false,
                'php_unit_dedicate_assert_internal_type' => false,
                'php_unit_expectation' => false,
                'php_unit_internal_class' => false,
                'php_unit_method_casing' => false,
                'php_unit_mock' => false,
                'php_unit_namespaced' => false,
                'php_unit_no_expectation_annotation' => false,
                'php_unit_ordered_covers' => true,
                'php_unit_set_up_tear_down_visibility' => true,
                'php_unit_size_class' => false,
                'php_unit_strict' => false,
                'php_unit_test_annotation' => false,
                'php_unit_test_case_static_method_calls' => ['call_type' => 'this'],
                'php_unit_test_class_requires_covers' => false,
                'phpdoc_add_missing_param_annotation' => ['only_untyped' => true],
                'phpdoc_line_span' => true,
                'phpdoc_no_empty_return' => true,
                'phpdoc_order' => true,
                'phpdoc_to_param_type' => false,
                'phpdoc_to_return_type' => $this->supports('type_annotations'),
                'phpdoc_var_annotation_correct_order' => true,
                'pow_to_exponentiation' => $this->supports('exponentiation'),
                // 'pre_increment' => true,
                'protected_to_private' => false,
                'psr0' => true,
                'random_api_migration' => false,
                'return_assignment' => true,
                'self_static_accessor' => true,
                // 'silenced_deprecation_error' => true,
                'simple_to_complex_string_variable' => true,
                'simplified_null_return' => true,
                'static_lambda' => false,
                'strict_comparison' => true,
                'strict_param' => true,
                'string_line_ending' => true,
                'ternary_to_null_coalescing' => $this->supports('null_coalescing'),
                'void_return' => $this->supports('void_return'),
                'yoda_style' => false,
            ]);
    }

    /**
     * @param string|string[] $folders
     * @param string|null     $target
     * @param string|string[] $exclude folder to exclude
     *
     * @return $this
     */
    public static function fromFolders($folders, $target = null, $exclude = [])
    {
        $config = new static($target);

        return $config->setFinder(
            Finder::create()->in($folders)->exclude($exclude)
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
     * @return $this
     */
    public function mergeRules(array $rules)
    {
        return $this->setRules(array_merge(
            $this->getRules(),
            $rules
        ));
    }

    /**
     * @return $this
     */
    public function enablePhpunitRules()
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
