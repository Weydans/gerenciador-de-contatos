<?php

namespace App\Domain\Repository;

use App\Domain\Model\Contact;

class ContactDoctrineRepository extends DoctrineRepository
{
	protected $entityClass = Contact::class;

	public function __construct()
	{
		parent::__construct();
	}
}

