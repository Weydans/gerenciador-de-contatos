<?php

namespace App\Controller;

use Lib\Controller;
use App\Model\Person;

class PersonController extends Controller
{
	public function read() 
	{
		$person = new Person( null, 'weydans', 1234567890 );

		//return $this->responseJson( 200, 'success' );
	}
	
	public function create() 
	{

		return $this->responseJson( 201, 'success' );
	}

	public function update() 
	{

		return $this->responseJson( 200, 'success' );
	}

	public function delete() 
	{

		return $this->responseJson( 200, 'success' );
	}
}

