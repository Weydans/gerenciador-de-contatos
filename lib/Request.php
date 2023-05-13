<?php

namespace Lib;

class Request
{
	private $get;
	private $post;
	private $server;

	public function __construct()
	{
		$this->get    = ( object ) filter_input_array( INPUT_GET, FILTER_DEFAULT );	
		$this->post   = ( object ) filter_input_array( INPUT_POST, FILTER_DEFAULT );
		$this->server = ( object ) array_change_key_case( $_SERVER, CASE_LOWER );

		$this->setRequestUri();
	}

	public function __get( string $prop )
	{
		if ( empty( $this->$prop ) ) {	
			throw new \Exception("Request has no member called '{$prop}'");
		}

		return $this->$prop;
	}

	private function setRequestUri()
	{
		$uri = $this->server->request_uri;
		$startQueryString = strpos($uri, '?');

		if ( $startQueryString ) {
			$uri = substr($uri, 0, $startQueryString);
		}

		$uri = empty( $uri ) ? '/' : $uri;
		$this->server->request_uri = $uri;
	}
}

