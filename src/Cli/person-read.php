<?php

use App\Domain\Repository\PersonRepository;

require_once( 'vendor/autoload.php' );

$repository = new PersonRepository();
$personList = $repository->all();

foreach( $personList as $person ) {
	echo "ID: {$person->id} \nNAME: {$person->name}\nCPF: {$person->cpf}\n\n";
}

