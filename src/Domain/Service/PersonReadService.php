<?php

namespace App\Domain\Service;

use App\Domain\Repository\RepositoryInterface;

/**
 * Service class responsible to recover all people from database
 * 
 * @author Weydans Barros
 */
abstract class PersonReadService
{
    /**
     * Recover all people
     * 
     * @param RepositoryInterface $repository person database interface
     * @return array|null return a person array on success or null on fail
     */
	public static function execute( RepositoryInterface $repository ) : ?array 
	{
		return $repository->all();
	}
}
