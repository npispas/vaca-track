<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/app')
    ->in(__DIR__ . '/public');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'blank_line_after_opening_tag' => true,
        'ordered_imports' => true,
        'no_unused_imports' => true,
        'single_quote' => true,
        'no_trailing_whitespace' => true,
        'phpdoc_trim' => true,
        'whitespace_after_comma_in_array' => true,
    ])
    ->setIndent("    ")
    ->setLineEnding("\n")
    ->setFinder($finder);