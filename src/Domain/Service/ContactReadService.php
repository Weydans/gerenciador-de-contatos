<?php

namespace App\Domain\Service;

use App\Domain\Repository\ContactDoctrineRepository;

/**
 * Service class responsible to get all contacts
 * 
 * @author Weydans Barros
 */
abstract class ContactReadService
{
    /**
     * Recover all contacts
     * 
     * @param ContactDoctrineRepository $repository contact database inteface
     * @return array|null
     */
	public static function execute( ContactDoctrineRepository $repository ) : ?array 
	{
		return $repository->all();
	}
}
