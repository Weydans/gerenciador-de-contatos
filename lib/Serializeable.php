<?php

namespace Lib;

use Lib\SerializeableInterface;

trait Serializeable
{
	public function toJson() : array
	{
		$arrData = [];

		foreach ( $this->serializeable as $field ) {
			if ( is_scalar( $this->$field ) || is_array( $this->$field ) || $this->$field instanceof \stdClass ) {
				$arrData[ $field ] = $this->$field;
			} else if ( $this->$field instanceof SerializeableInterface ) {
				$arrData[ $field ] = $this->$field->toJson();
			}
		}

		return $arrData; 
	}
}

