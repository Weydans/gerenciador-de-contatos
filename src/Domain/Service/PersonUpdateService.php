<?php

namespace App\Domain\Service;

use App\Domain\Model\Person;
use App\Domain\Repository\RepositoryInterface;

/**
 * Service class responsible to update a person from database
 * 
 * @author Weydans Barros
 */
abstract class PersonUpdateService
{
    /**
     * Update a person
     * 
     * @param \stdClass $personDto person data
     * @param RepositoryInterface $repository person database interface
     * @return Person|null person updated on success or null on fail
     */
	public static function execute( \stdClass $personDto, RepositoryInterface $repository ) : ?Person 
	{
		$person = $repository->find( $personDto->id );

		$person->name = $personDto->name;
		$person->cpf = $personDto->cpf;
		
		$repository->save();

		return $person;
	}
}
