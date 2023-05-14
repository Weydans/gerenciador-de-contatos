<?php

namespace App\Domain\Repository;

use App\Domain\Exception\RegisterNotFoundException;
use App\Infrastructure\Db\Factory\EntityManagerFactory;

abstract class DoctrineRepository implements RepositoryInterface
{
	protected $entityClass = null;
	protected $manager;
	protected $repository;

	public function __construct()
	{
		$this->manager    = ( new EntityManagerFactory() )->create();
		$this->repository = $this->manager->getRepository( $this->entityClass );
	}

	public function searchByField( string $field, $value ) : array
	{
		#$result = $this->repository->findBy( [ $field => $value ] );
		$result = ( $this->manager->createQueryBuilder() )
			->select( 'e' )
			->from( $this->entityClass, 'e' )
			->where( "e.{$field} like :value" )
			->setParameter( ':value', "%$value%" )
			->getQuery()->getResult();
		
		if ( empty( $result ) ) {
			throw new RegisterNotFoundException( "Register with value '{$value}' not found" );
		}

		return $result;
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

	public function update( object $entity )
	{
		$this->manager->merge( $entity );

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

