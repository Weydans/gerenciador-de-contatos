<?php

namespace App\Domain\Repository;

use App\Domain\Exception\RegisterNotFoundException;
use App\Infrastructure\Db\Factory\EntityManagerFactory;

/**
 * Abstract class responsible to serve properties and default methods
 * to Doctrine repositories subclasses
 * 
 * @author Weydans Barros
 */
abstract class DoctrineRepository implements RepositoryInterface
{
	protected $entityClass = null;
	protected $manager;
	protected $repository;

    /**
     * Get a \Doctrine\ORM\EntityManager and set a repository
     */
	public function __construct()
	{
		$this->manager    = ( new EntityManagerFactory() )->create();
		$this->repository = $this->manager->getRepository( $this->entityClass );
	}

    /**
     * Search registers by given field and value
     * 
     * @param string $field field to search a value
     * @param type $value value to search on field
     * @return array register found
     * @throws RegisterNotFoundException on error
     */
	public function searchByField( string $field, $value ) : array
	{
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

    /**
     * Recover all data from an entity on database
     * 
     * @return array|null return resgisters array on sucess or null on fail
     */
	public function all() : ?array
	{
		return $this->repository->findAll();
	}

    /**
     * Find a register on database
     * 
     * @param int $id id to search
     * @return object|null return entity instance
     * @throws RegisterNotFoundException thows esception on register not found
     */
	public function find( int $id ) : ?object 
	{
		$entity = $this->manager->find( $this->entityClass, $id );

		if ( is_null( $entity ) ) {
			throw new RegisterNotFoundException( "Register with id {$id} not found" );
		}

		return $entity;
	}

    /**
     * Create a register on database
     * 
     * @param object $entity entity to create a register
     * @return object|null return new register on success
     */
	public function create( object $entity ) : ?object
	{
		$this->manager->persist( $entity );

		return $this->save();
	}

    /**
     * Update a register on database
     * 
     * @param object $entity entity to update
     * @return object|null return updated entity on success
     */
	public function update( object $entity ) : ?object
	{
		$this->manager->merge( $entity );

		return $this->save();
	}

    /**
     * Commit a transaction open
     * 
     * @return type
     */
	public function save()
	{
		return $this->manager->flush();
	}
	
    /**
     * Delete a register from database
     * 
     * @param int $id register id
     * @return bool return true on success or false on fail
     */
	public function delete( int $id ) : bool
	{
		$entity = $this->find( $id );

		$this->manager->remove( $entity );

		$this->save();

		return true;
	}
}
