<?php

namespace App\Domain\Service;

use App\Domain\Model\Contact;
use App\Domain\Repository\ContactDoctrineRepository;

/**
 * Service class responsible to search an specific contact from database
 * 
 * @author Weydans Barros
 */
abstract class ContactSearchService
{
    /**
     * Search a contact on database
     * 
     * @param string $field field to search a value
     * @param string $value value to search
     * @param ContactDoctrineRepository $contactRepository contact database interface
     * @return array contacts found
     */
	public static function execute( 
		string $field, 
		string $value, 
		ContactDoctrineRepository $contactRepository 
	) : array 
	{
		return $contactRepository->searchByField( $field, $value );
	}
}
