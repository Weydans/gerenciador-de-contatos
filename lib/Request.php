<?php

namespace Lib;

class Request
{
	private $get;
	private $post;
	private $server;

	use Getters, Issets;

	public function __construct()
	{
		$post = filter_input_array( INPUT_POST, FILTER_DEFAULT );
		$this->post = empty( $post ) ? json_decode( file_get_contents( 'php://input' ) ) :  ( object ) $post;

		$this->get    = ( object ) filter_input_array( INPUT_GET, FILTER_DEFAULT );	
		$this->server = ( object ) array_change_key_case( $_SERVER, CASE_LOWER );
		
		$this->setRequestUri();
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

