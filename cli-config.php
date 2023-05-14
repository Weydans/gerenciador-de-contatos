<?php

require 'vendor/autoload.php';

use Doctrine\Migrations\DependencyFactory;
use App\Infrastructure\Db\Factory\EntityManagerFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;

$config = new PhpFile('migrations.php'); 

$entityManager = ( new EntityManagerFactory )->create(); 

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));

