<?php

namespace App\Domain\Repository;

/**
 * Responsible to give a pattern repository 
 * 
 * @author Weydans Barros
 */
interface RepositoryInterface
{
	public function __construct();

	public function all() : ?array;

	public function find( int $id ) : ?object;

	public function create( object $person ) : ?object;

	public function update( object $entity ) : ?object;

	public function save();
	
	public function delete( int $id ) : bool;
}
