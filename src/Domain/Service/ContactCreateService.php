<?php

namespace App\Domain\Service;

use App\Domain\Model\Contact;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;

abstract class ContactCreateService
{
	public static function execute( 
		\stdClass $contactDto, 
		ContactDoctrineRepository $contactRepository, 
		PersonDoctrineRepository $personRepository
	) : Contact 
	{
		$person = $personRepository->find( $contactDto->personId );

		$contact = new Contact( $contactDto->type, $contactDto->description, $person );

		$person->addContact( $contact );

		$personRepository->save();

		return $contact;
	}
}

