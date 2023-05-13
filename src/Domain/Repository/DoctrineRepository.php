<?php

namespace App\Domain\Repository;

use App\Domain\Exception\RegisterNotFoundException;
use App\Infrastructure\Factory\EntityManagerFactory;

abstract class DoctrineRepository implements RepositoryInterface
{
	protected $entityClass = null;
	protected $manager;
	protected $repository;

	public function __construct()
	{
		$factory = new EntityManagerFactory();
		$this->manager = $factory->create();
		$this->repository = $this->manager->getRepository( $this->entityClass );
	}

	public function all() : ?array
	{
		return $this->repository->findAll();
	}

	public function find( int $id ) : ?object 
	{
		$entity = $this->manager->find( $this->entityClass, $id );

		if ( is_null( $entity ) ) {
			throw new RegisterNotFoundException( "Register with id {$id} not found" );
		}

		return $entity;
	}

	public function create( object $entity ) : ?object
	{
		$this->manager->persist( $entity );

		$this->save();
		
		return $entity;
	}

	public function save() : bool
	{
		$this->manager->flush();

		return true;
	}
	
	public function delete( int $id ) : bool
	{
		$entity = $this->find( $id );

		$this->manager->remove( $entity );

		$this->save();

		return true;
	}
}

