<?php

namespace App\Http\Controller;

use Lib\Controller;
use App\Model\Contact;
use App\Model\Person;
use App\Domain\Service\ContactReadService;
use App\Domain\Service\ContactCreateService;
use App\Domain\Service\ContactSearchService;
use App\Domain\Service\ContactUpdateService;
use App\Domain\Service\ContactDeleteService;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;
use App\Domain\Exception\RegisterNotFoundException;

class ContactController extends Controller
{
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
				$personId = $contact->person->id;
				$this->data[] = array_merge( $contact->toJson(), [ 'personId' => $personId ]);
			}

			return $this->responseJson( 200, 'success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';
			return $this->responseJson( 500, $message );
		} 

	}
	
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

			$personId = $contact->person->id;
			$this->data = $contact->toJson();
			$this->data['personId'] = $personId;
			
			return $this->responseJson( 201, 'success' );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';
			return $this->responseJson( 500, $message );
		} 
	}

	public function show() 
	{
		try {
			$contact = ContactSearchService::execute( 'id', $this->request->id, new ContactDoctrineRepository() );
			$personId = $contact[0]->person->id;
			$this->data = $contact[0]->toJson();
			$this->data['personId'] = $personId;
			
			return $this->responseJson( 200, 'success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';
			return $this->responseJson( 500, $message );
		} 
	}

	public function update() 
	{
		try {
			if ( 	empty( $this->request->id )
				 ||	!is_bool( $this->request->type ) 
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

			$personId = $contact->person->id;
			$this->data = $contact->toJson();
			$this->data['personId'] = $personId;
			
			return $this->responseJson( 200, 'success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';
			return $this->responseJson( 500, $message );
		} 
	}

	public function delete() 
	{

	}
}

