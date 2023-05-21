<?php

namespace App\Domain\Service;

use App\Domain\Model\Contact;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;

/**
 * Service class responsible to update a contact on database
 * 
 * @author Weydans Barros
 */
abstract class ContactUpdateService
{
    /**
     * Update a contact on database
     * 
     * @param \stdClass $contactDto contact data
     * @param ContactDoctrineRepository $contactRepository Contact database interface
     * @param PersonDoctrineRepository $personRepository person database interface
     * @return Contact contact updated
     */
	public static function execute( 
		\stdClass $contactDto, 
		ContactDoctrineRepository $contactRepository,
		PersonDoctrineRepository $personRepository
	) : Contact 
	{
		$contact = $contactRepository->find( $contactDto->id );

		if ( $contact->person->id  != $contactDto->personId ) {
			$person = $personRepository->find( $contactDto->personId );
			$contact->person = $person;
		} 

		$contact->type        = $contactDto->type;
		$contact->description = $contactDto->description;
		
		$contactRepository->update( $contact );

		return $contact;
	}
}
