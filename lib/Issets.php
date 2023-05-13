<?php

namespace Lib;

trait Issets 
{
	public function __isset( string $prop )
	{
		return isset( $this->$prop ) ? true : false;	
	}
}

