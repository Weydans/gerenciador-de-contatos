<?php

use App\Domain\Service\PersonReadService;
use App\Domain\Repository\PersonDoctrineRepository;

require_once( 'vendor/autoload.php' );

try {
	$personList = PersonReadService::execute( new PersonDoctrineRepository() );

	foreach( $personList as $person ) {
		echo "ID: {$person->id} \nNAME: {$person->name}\nCPF: {$person->cpf}\n\n";
	}

} catch ( \Exception $e ) {
	
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

