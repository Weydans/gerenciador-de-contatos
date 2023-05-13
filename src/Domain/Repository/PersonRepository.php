<?php

namespace App\Domain\Repository;

use App\Domain\Model\Person;
use App\Domain\Exception\PersonNotFoundException;
use App\Infrastructure\Factory\EntityManagerFactory;

class PersonRepository
{
	private $manager;
	private $repository;

	public function __construct()
	{
		$factory = new EntityManagerFactory();
		$this->manager = $factory->create();
		$this->repository = $this->manager->getRepository( Person::class );
	}

	public function all() : ?array
	{
		return $this->repository->findAll();
	}

	public function find( int $id ) 
	{
		$person = $this->manager->find( Person::class, $id );

		if ( is_null( $person ) ) {
			throw new PersonNotFoundException( "Person with id {$id} not found" );
		}

		return $person;
	}

	public function create( Person $person )
	{
		$this->manager->persist( $person );

		$this->save();
		
		return $person;
	}

	public function save() : bool
	{
		$this->manager->flush();

		return true;
	}
	
	public function delete( int $id ) : bool
	{
		$person = $this->find( $id );

		$this->manager->remove( $person );

		$this->save();

		return true;
	}
}

