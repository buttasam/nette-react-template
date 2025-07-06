<?php

$finder = PhpCsFixer\Finder::create()
	->in(__DIR__ . '/app');

return (new PhpCsFixer\Config())
	->setRules([
		'@PSR12' => true,
		'array_syntax' => ['syntax' => 'short'],
		'no_unused_imports' => true,
		'binary_operator_spaces' => ['default' => 'single_space'],
		'phpdoc_align' => ['align' => 'left'],
		'declare_strict_types' => true,
		'no_superfluous_phpdoc_tags' => true,
		'single_quote' => true,
		'class_attributes_separation' => ['elements' => ['method' => 'one']],
		'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
		'indentation_type' => true,
	])
	->setRiskyAllowed(true)
	->setFinder($finder);