<?php

namespace Lib;

trait Getters
{
	public function __get( string $prop )
	{
		if ( !property_exists( $this, $prop ) ) {	
			return null;
		}

		$method = 'get' . ucfirst( $prop );

		if ( method_exists( $this, $method ) ) {
			return call_user_func( [ $this, $method ] );
		}

		return $this->$prop;
	}
}

