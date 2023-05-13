<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use App\Domain\Model\Factory\EntityManagerFactory;

require_once( __DIR__ . '/../vendor/autoload.php' );

$factory = new EntityManagerFactory();

$entityManager = $factory->create();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
