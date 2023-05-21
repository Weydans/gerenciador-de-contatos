<?php

namespace App\Infrastructure\Db\Factory;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

/**
 * Structure class responsible to create a Doctrine EntityManager
 * 
 * @author Weydans Barros
 */
class EntityManagerFactory
{
    /**
     * Create Doctrine EntityManager
     * 
     * @return EntityManager Doctrine EntityManager
     */
	public function create() : EntityManager
	{
		$config = ORMSetup::createAttributeMetadataConfiguration(
			paths: array(__DIR__ . "/../../../Domain/Model/"),
			isDevMode: true,
		);
		
		$connection = DriverManager::getConnection( [
			'driver'   => $_ENV['DB_DRIVER'],
			'host'     => $_ENV['DB_HOST'],
			'port'     => $_ENV['DB_PORT'],
			'dbname'   => $_ENV['DB_DATABASE'],
			'user'     => $_ENV['DB_USERNAME'],
			'password' => $_ENV['DB_PASSWORD'],
		], $config);

		return new EntityManager($connection, $config);	
	}
}
