<?php

namespace App\Http\Controller;

use Lib\Controller;
use App\Domain\Service\ContactReadService;
use App\Domain\Service\ContactCreateService;
use App\Domain\Service\ContactSearchService;
use App\Domain\Service\ContactUpdateService;
use App\Domain\Service\ContactDeleteService;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;
use App\Domain\Exception\RegisterNotFoundException;

/**
 * Controller class responsible to handle contact http actions 
 * 
 * @author Weydans Barros
 */
class ContactController extends Controller
{
    /**
     * Recover all contacts and search contacts
     * 
     * @return string jsom with list of contacts
     */
	public function read() 
	{
		try {
			$contactList = [];
			
			if ( empty( $this->request->field ) && empty( $this->request->value ) ) {
				$contactList = ContactReadService::execute( new ContactDoctrineRepository() );
		
			} else {
				$contactList = ContactSearchService::execute( 
					$this->request->field, 
					$this->request->value, 
					new ContactDoctrineRepository() 
				);
			}

			$this->data = [];
			foreach ( $contactList as $contact ) {
				$person = $contact->person;
				$this->data[] = array_merge( $contact->toJson(), [ 'person' => $person->toJson() ]);
			}

			return $this->responseJson( 200, 'success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on contatct list';
			return $this->responseJson( 500, $message );
		} 
	}
	
    /**
     * Create a new contact
     * 
     * @return string jsom contact created or an error message
     */
	public function create() 
	{
		try {
			if (    !is_bool( $this->request->type ) 
				 || empty( $this->request->description )
				 || empty( $this->request->personId ) 
			) {
				return $this->responseJson( 422, 'All fields are required' );
			}

			$contact = ContactCreateService::execute( 
				$this->request, 
				new ContactDoctrineRepository(), 
				new PersonDoctrineRepository() 
			);

			$person = $contact->person;
			$this->data = $contact->toJson();
			$this->data['person'] = $person->toJson();
			
			return $this->responseJson( 201, 'Contact created with success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on create contact';
			return $this->responseJson( 500, $message );
		} 
	}

    /**
     * Recover a contact by id given
     * 
     * @return string jsom contact found or an error message
     */
	public function show() 
	{
		try {
			$contact = ContactSearchService::execute( 'id', $this->request->id, new ContactDoctrineRepository() );
			$person = $contact[0]->person->toJson();
			$this->data = $contact[0]->toJson();
			$this->data['person'] = $person;
			
			return $this->responseJson( 200, 'success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on show contact';
			return $this->responseJson( 500, $message );
		} 
	}

    /**
     * Update a contact
     * 
     * @return string jsom contact updated or error message
     */
	public function update() 
	{
		try {
			if ( 	empty( $this->request->id )
				 ||	( $this->request->type != '1' && $this->request->type != '0' ) 
				 || empty( $this->request->description )
				 || empty( $this->request->personId ) 
			) {
				return $this->responseJson( 422, 'All fields are required' );
			}

			$contact = ContactUpdateService::execute( 
				$this->request, 
				new ContactDoctrineRepository(), 
				new PersonDoctrineRepository()
			);

			$person = $contact->person;
			$this->data = $contact->toJson();
			$this->data['person'] = $person->toJson();
			
			return $this->responseJson( 200, 'Contact updated with success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on update contact';
			return $this->responseJson( 500, $message );
		} 
	}

    /**
     * Delete a contact 
     * 
     * @return string|null return a string message on error or null on success
     */
	public function delete() 
	{
		try {
			ContactDeleteService::execute( $this->request->id, new ContactDoctrineRepository() );
			return $this->responseJson( 204, '' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on contact remove';
			return $this->responseJson( 500, $message );
		} 
	}
}
