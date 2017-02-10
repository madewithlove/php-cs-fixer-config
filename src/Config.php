<?php

namespace Madewithlove\PhpCsFixer;

use PhpCsFixer\Finder;

class Config extends \PhpCsFixer\Config
{
    /**
     * Create a new MWL configuration
     */
    public function __construct()
    {
        parent::__construct('madewithlove');

        $this
            ->setRiskyAllowed(true)
            ->setRules([
                '@Symfony' => true,
                'array_syntax' => ['syntax' => 'short'],
                'class_keyword_remove' => false,
                'combine_consecutive_unsets' => true,
                'declare_strict_types' => false,
                'dir_constant' => true,
                'ereg_to_preg' => true,
                'general_phpdoc_annotation_remove' => false,
                'header_comment' => false,
                'heredoc_to_nowdoc' => false,
                'linebreak_after_opening_tag' => true,
                'mb_str_functions' => true,
                'modernize_types_casting' => true,
                'no_blank_lines_before_namespace' => false,
                'no_multiline_whitespace_before_semicolons' => true,
                'no_php4_constructor' => true,
                'no_short_echo_tag' => true,
                'no_unreachable_default_argument_value' => true,
                'no_useless_else' => true,
                'no_useless_return' => true,
                'not_operator_with_space' => false,
                'not_operator_with_successor_space' => false,
                'ordered_class_elements' => false,
                'ordered_imports' => true,
                'php_unit_strict' => false,
                'phpdoc_add_missing_param_annotation' => true,
                'phpdoc_order' => true,
                'pow_to_exponentiation' => true,
                'protected_to_private' => false,
                'psr0' => true,
                'psr4' => true,
                'random_api_migration' => false,
                'semicolon_after_instruction' => true,
                'simplified_null_return' => true,
                'strict_comparison' => true,
                'strict_param' => true,
            ]);
    }

    /**
     * @param string|string[] $folders
     *
     * @return $this
     */
    public static function fromFolders($folders)
    {
        return static::create()->setFinder(
            Finder::create()->in($folders)
        );
    }

    /**
     * Merge a set of rules with the core ones
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
}