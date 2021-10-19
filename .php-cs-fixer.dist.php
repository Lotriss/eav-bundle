<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude(['config', 'public', 'tests', 'var'])
;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PHP80Migration' => true,
        '@PHP80Migration:risky' => true,
    ])
    ->setFinder($finder)
    ;
