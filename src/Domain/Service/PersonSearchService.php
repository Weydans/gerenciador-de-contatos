<?php

namespace App\Domain\Service;

use App\Domain\Model\Person;
use App\Domain\Repository\PersonDoctrineRepository;

abstract class PersonSearchService
{
	public static function execute( 
		string $field, 
		string $value, 
		PersonDoctrineRepository $personRepository 
	) : array 
	{
		return $personRepository->searchByField( $field, $value );
	}
}

