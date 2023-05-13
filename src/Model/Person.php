<?php

namespace App\Model;

use Lib\Getters;
use Lib\Setters;
use Lib\Issets;

class Person
{
	private $id;
	private $name;
	private $cpf;

	use Getters, Setters, Issets;

	public function __construct( $id, string $name, string $cpf )
	{
		$this->id   = $id;
		$this->name = $name;
		$this->cpf  = $cpf;
	}

	public function setName( string $name )
	{
		$this->name = $name;
	}

	public function setCpf( string $cpf )
	{
		$this->cpf = $cpf;
	}
}

