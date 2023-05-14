<?php

namespace App\Domain\Service;

use App\Domain\Repository\ContactDoctrineRepository;

abstract class ContactReadService
{
	public static function execute( ContactDoctrineRepository $repository ) : ?array 
	{
		return $repository->all();
	}
}

