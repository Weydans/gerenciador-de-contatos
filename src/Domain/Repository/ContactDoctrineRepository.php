<?php

namespace App\Domain\Repository;

use App\Domain\Model\Contact;

/**
 * Repository responsible to manage contact database actions
 * 
 * @author Weydans Barros
 */
class ContactDoctrineRepository extends DoctrineRepository
{
	protected $entityClass = Contact::class;

    /**
     * Create a new instance of ContactDoctrineRepository
     * <b>Important:</b> the parent class __construct method must be called
     */
	public function __construct()
	{
		parent::__construct();
	}
}
