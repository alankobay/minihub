<?php

$finder = \PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude([
        'bootstrap',
        'storage',
        'vendor',
        'node_modules',
        '.docker',
    ])
    ->name('*.php')
    ->notName('_ide_helper*')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12'                 => true,
    'binary_operator_spaces' => [
        'default' => 'align_single_space_minimal',
    ],
    'concat_space' => [
        'spacing' => 'one',
    ],
    'no_useless_return'          => true,
    'ternary_to_null_coalescing' => true,
    'yoda_style'                 => false,
])
    ->setFinder($finder);
