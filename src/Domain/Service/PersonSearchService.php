<?php

namespace App\Domain\Service;

use App\Domain\Model\Person;
use App\Domain\Repository\PersonDoctrineRepository;

/**
 * Service class responsible to sesrch people from database
 * 
 * @author Weydans Barros
 */
abstract class PersonSearchService
{
    /**
     * Search people
     * 
     * @param string $field target field to search
     * @param string $value value to search from field
     * @param PersonDoctrineRepository $personRepository person database interface
     * @return array return a people list
     */
	public static function execute( 
		string $field, 
		string $value, 
		PersonDoctrineRepository $personRepository 
	) : array 
	{
		return $personRepository->searchByField( $field, $value );
	}
}
