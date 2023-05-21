<?php

namespace App\Domain\Repository;

use App\Domain\Model\Person;

/**
 * Repository responsible to manage person database actions
 * 
 * @author Weydans Barros
 */
class PersonDoctrineRepository extends DoctrineRepository
{
	protected $entityClass = Person::class;
    
    /**
     * Create a new instance of PersonDoctrineRepository
     * <b>Important:</b> the parent class __construct method must be called
     */
	public function __construct()
	{
		parent::__construct();
	}
}
