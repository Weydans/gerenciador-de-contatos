<?php

namespace App\Domain\Model;

use Lib\Issets;
use Lib\Getters;
use Lib\Setters;
use Lib\Serializeable;
use Lib\SerializeableInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity]
class Contact implements SerializeableInterface 
{
	#[Id]
	#[GeneratedValue]
	#[Column]
	private int $id;
	
	#[Column]
	private bool $type;
	
	#[Column]
	private string $description;
	
	#[ManyToOne(
		targetEntity: Person::class, 
		inversedBy: 'contacts',
		cascade: [ 'merge' ]
	)]
	private Person $person;

	private $serializeable = [ 'id', 'type', 'description' ];

	use Getters, Setters, Issets, Serializeable;

	public function __construct( bool $type, string $description, Person $person )
	{
		$this->setType( $type );
		$this->setDescription( $description );
		$this->setPerson( $person );
	}

	public function setType( bool $type )
	{
		$this->type = $type;
	}

	public function setDescription( string $description )
	{
		if ( mb_strlen( $description) < 3 || mb_strlen( $description) > 191 ) {
			throw new \Exception( 'Description must be between 3 ans 191 charactes' );
		}

		$this->description = $description;
	}

	public function setPerson( Person $person )
	{
		$this->person = $person;
	}
}

