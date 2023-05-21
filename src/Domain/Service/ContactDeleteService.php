<?php

namespace App\Domain\Service;

use App\Domain\Repository\RepositoryInterface;

/**
 * Service class responsible to execute a contact deletion
 * 
 * @author Weydans Barros
 */
abstract class ContactDeleteService
{
    /**
     * Delete a contact
     * 
     * @param int $id contact id to remove
     * @param RepositoryInterface $repository contact database interface
     * @return bool return true on succes or false on fail
     */
	public static function execute( int $id, RepositoryInterface $repository ) : bool 
	{
		return $repository->delete( $id );
	}
}
