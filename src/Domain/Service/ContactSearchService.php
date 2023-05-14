<?php

namespace App\Domain\Service;

use App\Domain\Model\Contact;
use App\Domain\Repository\ContactDoctrineRepository;

abstract class ContactSearchService
{
	public static function execute( 
		string $field, 
		string $value, 
		ContactDoctrineRepository $contactRepository 
	) : array 
	{
		return $contactRepository->searchByField( $field, $value );
	}
}

