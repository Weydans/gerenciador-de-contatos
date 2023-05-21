<?php

namespace App\Domain\Service;

use App\Domain\Model\Contact;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;

/**
 * Service class responsible to execute a contact creation
 * 
 * @author Weydans Barros
 */
abstract class ContactCreateService
{
    /**
     * Executes a contatact creation
     * 
     * @param \stdClass $contactDto contact data
     * @param ContactDoctrineRepository $contactRepository contact database interface
     * @param PersonDoctrineRepository $personRepository person database interface
     * @return Contact contact created
     */
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
