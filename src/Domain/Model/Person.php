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
use App\Domain\Validation\CPFValidator;

#[Entity]
/**
 * Responsible to represent a person in system
 * @author Weydans Barros
 */
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
	
	/**
	 * Creates a new Person
	 *
	 * @param  string $name Person name
	 * @param  string $cpf  Person cpf
	 * @return Person
	 */
	public function __construct( string $name, string $cpf )
	{
		$this->setName( $name );
		$this->setCpf( $cpf );

		$this->contacts = new ArrayCollection();
	}

	/**
	 * Returns a Person contacts list 
	 *
	 * @return array contacts list
     * @codeCoverageIgnore
	 */
	public function getContacts() {
		return $this->contacts->toArray();
	}

	/**
	 * Add new contact to cotacts list 
	 *
	 * @param Contact $contact contact entity
	 * @return void
	 */
	public function addContact( Contact $contact )
	{
		$this->contacts->add( $contact );
	}

	/**
	 * Remove a contact from cotacts list 
	 *
	 * @param Contact $contact contact entity
	 * @return void
	 */
	public function removeContact( Contact $contact )
	{
		$this->contacts->removeElement( $contact );
	}

	/**
	 * Set a person name or thows Exception on invalid value
	 *
	 * @param string $name person name
	 * @throws Exception
	 * @return void
	 */
	public function setName( string $name )
	{
		if ( mb_strlen( $name ) < 3 || mb_strlen( $name ) > 191 ) {
			throw new \Exception( 'Name must be between 3 ans 191 charactes' );
		}

		$this->name = $name;
	}

	/**
	 * Set a person cpf or thows Exception on invalid value
	 *
	 * @param string $cpf person cpf
	 * @throws Exception
	 * @return void
	 */
	public function setCpf( string $cpf )
	{
		$cpfValidator = new CPFValidator( $cpf );

		if ( !$cpfValidator->isValid() ) {
			throw new \Exception( $cpfValidator->getError() );
		}

		$this->cpf = $cpf;
	}
}
