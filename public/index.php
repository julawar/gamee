<?php

$container = require __DIR__ . '/../app/bootstrap.php';

$container->getByType(App\Application::class)
    ->run();

