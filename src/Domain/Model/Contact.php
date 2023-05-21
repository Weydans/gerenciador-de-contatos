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
/**
 * Represents a person contact on system
 * 
 * @author Weydans Barros
 */
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

    /**
     * Create a new instance of Contact entity
     * 
     * @param bool $type contact type [ 0 = E-mail, 1 = Phone ]
     * @param string $description e-mail address or phone number
     * @param Person $person owner of the contact
     */
	public function __construct( bool $type, string $description, Person $person )
	{
		$this->setType( $type );
		$this->setDescription( $description );
		$this->setPerson( $person );
	}

    /**
     * Set a contact type [ 0 = E-mail, 1 = Phone ]
     * 
     * @param bool $type
     * @return void
     * 
     * @codeCoverageIgnore
     */
	public function setType( bool $type )
	{
		$this->type = $type;
	}

    /**
     * Set a contact description or throws exception on invalid value
     * 
     * @param string $description e-mail address or phone number
     * @throws \Exception
     * @return void
     */
	public function setDescription( string $description )
	{
		if ( mb_strlen( $description) < 3 || mb_strlen( $description) > 191 ) {
			throw new \Exception( 'Description must be between 3 ans 191 charactes' );
		}

		$this->description = $description;
	}

    /**
     * Set a contact owner
     * 
     * @param Person $person contact owner
     * 
     * @codeCoverageIgnore
     */
	public function setPerson( Person $person )
	{
		$this->person = $person;
	}
}
