<?php

namespace Lib;

trait Getters
{
	public function __get( string $prop )
	{
		$method = 'get' . ucfirst( $prop );

		if ( !property_exists( $this, $prop ) && !method_exists( $this, $method ) ) {	
			return null;
		}

		if ( method_exists( $this, $method ) ) {
			return call_user_func( [ $this, $method ] );
		}

		return $this->$prop;
	}
}

