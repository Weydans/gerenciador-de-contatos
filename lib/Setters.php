<?php

namespace Lib;

trait Setters
{
	public function __set( string $prop, $value )
	{
		if ( !property_exists( $this, $prop ) ) {	
			throw new \Exception( "Prpperty '{$prop}' not found in " . $this::class );
		}

		$method = 'set' . ucfirst( $prop );

		if ( method_exists( $this, $method ) ) {
			call_user_func( [ $this, $method ], $value );
			return;
		}

		$this->$prop = $value;
	}
}

