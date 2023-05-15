<?php

namespace Lib;

use Lib\Request;
use Lib\Response;

class Route
{
	private $request;

	public function __construct(Request $request) 
	{
		$this->request = $request;	
	}

	public function get( string $route, string $controller, string $method) : void
	{
		if ( $this->request->server->request_method == 'GET' ) {
			$this->processRoute($route, $controller, $method);
		}
	}

	public function post( string $route, string $controller, string $method) : void
	{
		if ( empty( $this->request->post->httpVerb ) && $this->request->server->request_method == 'POST') {
			$this->processRoute($route, $controller, $method);
		}
	}

	public function put( string $route, string $controller, string $method ) : void
	{
		if ( $this->request->server->request_method == 'PUT' )	{
			$this->processRoute($route, $controller, $method);
		}
	}

	public function delete(	string $route, string $controller, string $method) : void
	{
		if ( $this->request->server->request_method == 'DELETE' ) {
			$this->processRoute($route, $controller, $method);
		}
	}

	private function processRoute( string $route, string $controller, string $method) : void
	{
		if ( $this->routesEquals($route) ) {
			$this->execAction( $controller, $method );
		}

		$uri = explode( '/', $this->request->server->request_uri );
		$route = explode( '/', $route );

		if ( count( $uri ) != count( $route ) )	{
			return;
		}

		for ($i = 0; $i < count($route); $i++) {
			$resource = $route[$i];

			if ( !empty( $resource[0] ) && $resource[0] == '$' && strlen( $resource ) > 1 ) {
				$param = substr( $resource, 1, strlen( $resource ) );
				$this->request->get->$param = $uri[$i];
				$route[$i] = $uri[$i];
			}
		}

		$route = implode( '/', $route );
		
		if ( $this->routesEquals( $route ) ) {
			$this->execAction( $controller, $method );
		}
	}

	private function execAction( string $controller, string $method )
	{
		$object = new $controller( $this->request, new Response() );
		$object->$method();
		exit();
	}

	private function routesEquals( string $route ) : bool
	{
		return $route == $this->request->server->request_uri ? true : false;
	}
}

