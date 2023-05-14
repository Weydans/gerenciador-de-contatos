<?php

namespace App\Infrastructure\Db\Factory;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
	public function create() : EntityManager
	{
		$config = ORMSetup::createAttributeMetadataConfiguration(
			paths: array(__DIR__ . "/../../../Domain/Model/"),
			isDevMode: true,
		);
		
		$dbConfig   = require_once( __DIR__ . '/../../../../migrations-db.php' );
		$connection = DriverManager::getConnection( $dbConfig, $config);

		return new EntityManager($connection, $config);	
	}
}

