<?php

namespace App\Domain\Service;

use App\Domain\Repository\RepositoryInterface;

abstract class PersonDeleteService
{
	public static function execute( int $id, RepositoryInterface $repository ) : bool 
	{
		return $repository->delete( $id );
	}
}

