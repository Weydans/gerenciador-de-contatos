<?php

namespace App\Domain\Service;

use App\Domain\Model\Person;
use App\Domain\Repository\RepositoryInterface;

abstract class PersonCreateService
{
	public static function execute( \stdClass $personDto, RepositoryInterface $repository ) : Person 
	{
		$person = new Person( $personDto->name, $personDto->cpf );

		return $repository->create( $person );
	}
}

