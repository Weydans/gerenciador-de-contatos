<?php

namespace Lib;

use \stdclass;
use \Exception;

class Response
{
	private $httpCode;
	private $message;
	private $data;

	use Issets;

	public function __construct()
	{
		$this->message = '';
		$this->httpCode = '';
		$this->data = new stdclass();
	}

	public function __set( string $prop, $value )
	{
		if ( !property_exists( $this, $prop ) ) {
			$this->data->$prop = $value;
			return;
		}

		$this->$prop = $value;
	}

	public function __get( string $prop )
	{
		if ( property_exists( $this, $prop ) ) {
			return $this->$prop;
		}

		if ( property_exists( $this->data, $prop ) ) {
			return $this->data->$prop;
		}

		return null;
	}

	public function toJson()
	{
		return json_encode([
			'httpCode' 		=> $this->httpCode,
			'message'		=> $this->message,
			'data'			=> $this->data,
		]);
	}
}

