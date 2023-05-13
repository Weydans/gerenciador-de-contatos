<?php

namespace Lib;

use \stdclass;
use \Exception;
use Lib\Request;

abstract class Controller
{
	protected $request;
	protected $get;
	protected $post;
	protected $data;
	private $response;

	public function __construct( Request $request, Response $response )
	{
		$this->get 		= $request->get;
		$this->post 	= $request->post;
		$this->request 	= $request;
		$this->response = $response;
		$this->data		= new stdclass();
	}

	public function getResponse( int $httpCode, string $message ) : Response 
	{
		$this->setResponse( $httpCode, $message );
		
		return $this->response;
	}

	public function responseJson( int $httpCode, string $message ) : void 
	{
        header( 'Content-Type: application/json' );
        header( 'Accept: application/json' );
        header( 'Access-Control-Allow-Methods: *' );
		
		$this->setResponse( $httpCode, $message );

		echo $this->response->toJson();	
	}

	private function setResponse( int $httpCode, string $message ) : void 
	{
		$this->response->httpCode 	= $httpCode;
		$this->response->message 	= $message;
		$this->response->data	 	= $this->data;
	}
}


