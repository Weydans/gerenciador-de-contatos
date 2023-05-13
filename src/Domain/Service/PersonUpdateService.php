<?php

namespace App\Domain\Service;

use App\Domain\Model\Person;
use App\Domain\Repository\RepositoryInterface;

abstract class PersonUpdateService
{
	public static function execute( \stdClass $personDto, RepositoryInterface $repository ) : Person 
	{
		$person = $repository->find( $personDto->id );

		$person->name = $personDto->name;
		$person->cpf = $personDto->cpf;
		
		$repository->save();

		return $person;
	}
}

