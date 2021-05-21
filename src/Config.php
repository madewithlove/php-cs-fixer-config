<?php

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
                '@Symfony' => true,
                'align_multiline_comment' => true,
                'array_indentation' => true,
                'array_syntax' => ['syntax' => 'short'],
                'backtick_to_shell_exec' => true,
                'combine_consecutive_issets' => true,
                'combine_consecutive_unsets' => true,
                'combine_nested_dirname' => true,
                'comment_to_phpdoc' => true,
                'compact_nullable_typehint' => true,
                'date_time_immutable' => false,
                'declare_strict_types' => false,
                'doctrine_annotation_array_assignment' => true,
                'doctrine_annotation_braces' => true,
                'doctrine_annotation_indentation' => true,
                'doctrine_annotation_spaces' => true,
                'escape_implicit_backslashes' => true,
                'explicit_indirect_variable' => true,
                'explicit_string_variable' => true,
                'final_class' => false,
                'final_internal_class' => false,
                'final_public_method_for_abstract_class' => false,
                'final_static_access' => true,
                'fully_qualified_strict_types' => true,
                'general_phpdoc_annotation_remove' => false,
                'global_namespace_import' => true,
                'header_comment' => false,
                'heredoc_indentation' => true,
                'heredoc_to_nowdoc' => false,
                'linebreak_after_opening_tag' => true,
                'list_syntax' => ['syntax' => 'short'],
                'logical_operators' => true,
                'mb_str_functions' => true,
                'method_chaining_indentation' => true,
                'multiline_comment_opening_closing' => true,
                'multiline_whitespace_before_semicolons' => true,
                'no_alternative_syntax' => true,
                'no_binary_string' => true,
                'no_blank_lines_before_namespace' => false,
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
                'phpdoc_to_return_type' => true,
                'phpdoc_var_annotation_correct_order' => true,
                'protected_to_private' => false,
                'psr0' => true,
                'random_api_migration' => false,
                'return_assignment' => true,
                'self_static_accessor' => true,
                'simple_to_complex_string_variable' => true,
                'simplified_null_return' => true,
                'static_lambda' => false,
                'strict_comparison' => true,
                'strict_param' => true,
                'string_line_ending' => true,
                'ternary_to_null_coalescing' => true,
                'void_return' => true,
                'yoda_style' => false,
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
