<?php

namespace App\Domain\Service;

use App\Domain\Model\Contact;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;

abstract class ContactUpdateService
{
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
		
		return $contactRepository->update( $contact );
	}
}

