<?php

namespace App\Domain\Model;

use Lib\Getters;
use Lib\Setters;
use Lib\Issets;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity]
class Person
{
	#[Id]
	#[GeneratedValue]
	#[Column]
	private int $id;
	
	#[Column]
	private string $name;
	
	#[Column]
	private string $cpf;

	use Getters, Setters, Issets;

	public function __construct( string $name, string $cpf )
	{
		$this->setName( $name );
		$this->setCpf( $cpf );
	}

	public function setName( string $name )
	{
		if ( mb_strlen( $name ) < 3 || mb_strlen( $name ) > 191 ) {
			throw new \Exception( 'Name must be between 3 ans 191 charactes' );
		}

		$this->name = $name;
	}

	public function setCpf( string $cpf )
	{
		if ( mb_strlen( $cpf ) != 11 || !is_numeric( $cpf ) ) {
			throw new \Exception( 'Cpf must be 11 digits exactly' );
		}

		$this->cpf = $cpf;
	}
}

