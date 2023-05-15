<?php

namespace App\Domain\Model;

use Lib\Getters;
use Lib\Setters;
use Lib\Issets;
use Lib\Serializeable;
use Lib\SerializeableInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[Entity]
class Person implements SerializeableInterface
{
	#[Id]
	#[GeneratedValue]
	#[Column]
	private int $id;
	
	#[Column]
	private string $name;
	
	#[Column]
	private string $cpf;

	#[OneToMany(
		targetEntity: Contact::class, 
		mappedBy: 'person', 
		cascade: ['persist', 'remove']
	)]
	private Collection $contacts;

	private $serializeable = [ 'id', 'name', 'cpf', 'contacts' ];

	use Getters, Setters, Issets, Serializeable;

	public function __construct( string $name, string $cpf )
	{
		$this->setName( $name );
		$this->setCpf( $cpf );

		$this->contacts = new ArrayCollection();
	}
	
	public function getContacts() {
		return $this->contacts->toArray();
	}

	public function addContact( Contact $contact )
	{
		$this->contacts->add( $contact );
	}

	public function removeContact( Contact $contact )
	{
		$this->contacts->removeElement( $contact );
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

