<?php

namespace App\Domain\Repository;

interface RepositoryInterface
{
	public function __construct();

	public function all() : ?array;

	public function find( int $id ) : ?object;

	public function create( object $person ) : ?object;

	public function save() : bool;
	
	public function delete( int $id ) : bool;
}

