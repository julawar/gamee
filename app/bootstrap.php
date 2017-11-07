<?php

use Nette\DI\ContainerLoader;

require __DIR__ . '/../vendor/autoload.php';

$containerLoader = new ContainerLoader(__DIR__ . '/../temp', TRUE);
$class = $containerLoader->load(function($compiler) {
    $compiler->loadConfig(__DIR__ . '/../config/config.neon');
});

$container = new $class;
return $container;
