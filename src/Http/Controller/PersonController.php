<?php

namespace App\Http\Controller;

use Lib\Controller;
use App\Domain\Service\PersonReadService;
use App\Domain\Service\PersonCreateService;
use App\Domain\Service\PersonSearchService;
use App\Domain\Service\PersonUpdateService;
use App\Domain\Service\PersonDeleteService;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Exception\RegisterNotFoundException;

/**
 * Controller class responsible to handle person http actions 
 * 
 * @author Weydans Barros
 */
class PersonController extends Controller
{
    /**
     * Recover all people or only those according to the filter
     * 
     * @return string jsom people list or an error message
     */
	public function read() 
	{
		try {
			$personList = [];
			
			if ( empty( $this->request->field ) && empty( $this->request->value ) ) {
				$personList = PersonReadService::execute( new PersonDoctrineRepository() );
		
			} else {
				$personList = PersonSearchService::execute( 
					$this->request->field, 
					$this->request->value, 
					new PersonDoctrineRepository() 
				);
			}

			$response = [];
			foreach ( $personList as $person ) {
				$arrPerson = $person->toJson();
				foreach ( $person->contacts as $contact ) {
					$arrPerson['contacts'][] = $contact->toJson();
				}
				$response[] = $arrPerson;
			}

			$this->data = $response;
			return $this->responseJson( 200, 'success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on list people';
			return $this->responseJson( 500, $message );
		} 
	}
	
    /**
     * Create a new person
     * 
     * @return string jsom person created or an error message
     */
	public function create() 
	{
		try {
			if ( empty( $this->request->name ) || empty( $this->request->cpf ) ) {
				return $this->responseJson( 422, 'All fields are required' );
			}

			$person = PersonCreateService::execute( $this->request, new PersonDoctrineRepository() );
			$this->data = $person->toJson();

			return $this->responseJson( 201, 'Person created with success' );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on create person';
			return $this->responseJson( 500, $message );
		} 
	}

    /**
     * Recover a person according the id given
     * 
     * @return string json with a person or an error message
     */
	public function show() 
	{
		try {
			$person = PersonSearchService::execute( 'id', $this->request->id, new PersonDoctrineRepository() );
			
			$contacts = [];
			foreach ( $person[0]->contacts as $contact ) {
				$contacts[] = $contact->toJson();
			}

			$this->data = array_merge( $person[0]->toJson(), [ 'contacts' => $contacts ] );
			return $this->responseJson( 200, 'success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on show person';
			return $this->responseJson( 500, $message );
		} 
	}

    /**
     * Update a person 
     * 
     * @return string jsom person updated or an error message
     */
	public function update() 
	{
		try {
			if ( empty( $this->request->name ) || empty( $this->request->cpf ) ) {
				return $this->responseJson( 422, 'All fields are required' );
			}

			$person = PersonUpdateService::execute( $this->request, new PersonDoctrineRepository() );
			$this->data = $person->toJson();
			return $this->responseJson( 200, 'Person updated with success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on update person';
			return $this->responseJson( 500, $message );
		} 
	}

    /**
     * Delete a person
     * 
     * @return string|null message on fail or no content on success
     */
	public function delete() 
	{
		try {
			PersonDeleteService::execute( $this->request->id, new PersonDoctrineRepository() );
			return $this->responseJson( 204, '' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Error on delete person';
			return $this->responseJson( 500, $message );
		} 
	}
}
