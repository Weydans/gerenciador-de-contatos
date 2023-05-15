<?php

namespace App\Http\Controller;

use Lib\Controller;
use App\Model\Person;
use App\Domain\Service\PersonReadService;
use App\Domain\Service\PersonCreateService;
use App\Domain\Service\PersonSearchService;
use App\Domain\Service\PersonUpdateService;
use App\Domain\Service\PersonDeleteService;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Exception\RegisterNotFoundException;

class PersonController extends Controller
{
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
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';
			return $this->responseJson( 500, $message );
		} 
	}
	
	public function create() 
	{
		try {
			if ( empty( $this->request->name ) || empty( $this->request->cpf ) ) {
				return $this->responseJson( 422, 'All fields are required' );
			}

			$person = PersonCreateService::execute( $this->request, new PersonDoctrineRepository() );
			$this->data = $person->toJson();

			return $this->responseJson( 201, 'success' );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';
			return $this->responseJson( 500, $message );
		} 
	}

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
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';
			return $this->responseJson( 500, $message );
		} 
	}

	public function update() 
	{
		try {
			if ( empty( $this->request->name ) || empty( $this->request->cpf ) ) {
				return $this->responseJson( 422, 'All fields are required' );
			}

			$person = PersonUpdateService::execute( $this->request, new PersonDoctrineRepository() );
			$this->data = $person->toJson();
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
		try {
			PersonDeleteService::execute( $this->request->id, new PersonDoctrineRepository() );
			return $this->responseJson( 204, 'success' );
		
		} catch ( RegisterNotFoundException $e ) {
			return $this->responseJson( 404, $e->getMessage() );
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';
			return $this->responseJson( 500, $message );
		} 
	}
}

