<?php

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

// Registers composer autoloader.
require __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
} catch (InvalidPathException $exception) {
    die('Make sure .env file exists.');
}

// Starts routes
require __DIR__ . '/../src/index.php';
