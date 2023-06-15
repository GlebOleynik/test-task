<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
$config
    ->setCacheFile(__DIR__ . '/var/.php-cs-fixer.cache')
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP82Migration' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        '@PER' => true,
    ])
    ->setFinder($finder);

return $config;