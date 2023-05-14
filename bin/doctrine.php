<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use App\Infrastructure\Factory\EntityManagerFactory;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once( __DIR__ . '/../vendor/autoload.php' );

$factory = new EntityManagerFactory();

$entityManager = $factory->create();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);

