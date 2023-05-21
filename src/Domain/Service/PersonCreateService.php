<?php

namespace App\Domain\Service;

use App\Domain\Model\Person;
use App\Domain\Repository\RepositoryInterface;

/**
 * Service class responsible to create person on database
 * 
 * @author Weydans Barros
 */
abstract class PersonCreateService
{
    /**
     * Create a new person
     * 
     * @param \stdClass $personDto person data
     * @param RepositoryInterface $repository person database interface
     * @return Person|null return a person on success or null on fail
     */
	public static function execute( \stdClass $personDto, RepositoryInterface $repository ) : ?Person 
	{
		$person = new Person( $personDto->name, $personDto->cpf );

		$repository->create( $person );

		return $person;
	}
}
