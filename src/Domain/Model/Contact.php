<?php

namespace App\Model;

use Lib\Getters;
use Lib\Setters;
use Lib\Issets;

use App\Model\Person;

class Contact 
{
	private $id;
	private $type;
	private $description;
	private $person;

	use Getters, Setters, Issets;

	public function __construct( $id, bool $type, string $description, Person $person )
	{
		$this->id          = $id;
		$this->type        = $type;
		$this->description = $description;
		$this->person      = $person;
	}

	public function setType( bool $type )
	{
		$this->type = $type;
	}

	public function setDescription( string $description )
	{
		$this->description = $description;
	}

	public function setPerson( Person $person )
	{
		$this->person = $person;
	}
}

