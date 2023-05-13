<?php

namespace App\Domain\Model\Factory;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
	public function create() : EntityManager
	{
		$config = ORMSetup::createAttributeMetadataConfiguration(
			paths: array(__DIR__."/src"),
			isDevMode: true,
		);

		// database connection
		$connection = DriverManager::getConnection([
			'driver' => 'pdo_sqlite',
			'path' => __DIR__ . '/db.sqlite',
		], $config);

		return new EntityManager($connection, $config);	
	}
}

