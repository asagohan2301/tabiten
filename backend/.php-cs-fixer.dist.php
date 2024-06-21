<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
      __DIR__ . '/app',
      __DIR__ . '/config',
      __DIR__ . '/database/factories',
      __DIR__ . '/database/seeders',
      __DIR__ . '/routes',
      __DIR__ . '/tests',
    ]);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'single_quote' => true,
        'no_extra_blank_lines' => true,
        'trailing_comma_in_multiline' => true,
        'no_unused_imports' => true,
    ])
    ->setFinder($finder);
