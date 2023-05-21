<?php

namespace App\Domain\Service;

use App\Domain\Repository\RepositoryInterface;

/**
 * Service class responsible to delete a person on database
 * 
 * @author Weydans Barros
 */
abstract class PersonDeleteService
{
    /**
     * Delete a person
     * 
     * @param int $id person id to delete
     * @param RepositoryInterface $repository person database interface
     * @return bool return true on success or false on fail
     */
	public static function execute( int $id, RepositoryInterface $repository ) : bool 
	{
		return $repository->delete( $id );
	}
}
