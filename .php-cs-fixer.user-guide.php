<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use CodeIgniter\CodingStandard\CodeIgniter4;
use Nexus\CsConfig\Factory;
use Nexus\CsConfig\Fixer\Comment\NoCodeSeparatorCommentFixer;
use Nexus\CsConfig\FixerGenerator;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->files()
    ->in([
        __DIR__ . '/user_guide_src/source',
    ])
    ->notPath([
        'ci3sample/',
        'database/query_builder/075.php',
        'libraries/sessions/016.php',
        'outgoing/response/031.php',
        'outgoing/response/032.php',
    ]);

$overrides = [
    'echo_tag_syntax'              => false,
    'php_unit_internal_class'      => false,
    'no_unused_imports'            => false,
    'class_attributes_separation'  => false,
    'fully_qualified_strict_types' => [
        'import_symbols'                        => false,
        'leading_backslash_in_global_namespace' => true,
    ],
    'phpdoc_array_type' => true,
    'phpdoc_align'      => [
        'align'   => 'vertical',
        'spacing' => 1,
        'tags'    => [
            'method',
            'param',
            'phpstan-assert',
            'phpstan-assert-if-true',
            'phpstan-assert-if-false',
            'phpstan-param',
            'phpstan-property',
            'phpstan-return',
            'phpstan-type',
            'phpstan-var',
            'property',
            'property-read',
            'property-write',
            'return',
            'throws',
            'type',
            'var',
        ],
    ],
];

$options = [
    'cacheFile' => 'build/.php-cs-fixer.user-guide.cache',
    'finder'    => $finder,
];

$config = Factory::create(new CodeIgniter4(), $overrides, $options)->forProjects();

$config
    ->registerCustomFixers(FixerGenerator::create('vendor/nexusphp/cs-config/src/Fixer', 'Nexus\\CsConfig\\Fixer'))
    ->setRules(array_merge($config->getRules(), [
        NoCodeSeparatorCommentFixer::name() => true,
    ]));

return $config;
