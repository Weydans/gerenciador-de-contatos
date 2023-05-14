<?php

use App\Domain\Service\PersonSearchService;
use App\Domain\Repository\PersonDoctrineRepository;

require_once( 'vendor/autoload.php' );

if ( $argc != 3 ) {
	echo "Usage: {$argv[0]} <field> <value>" . PHP_EOL;
	exit();
}

try {
	$persons = PersonSearchService::execute( 
		$argv[1], 
		$argv[2], 
		new PersonDoctrineRepository() 
	);
	
	foreach ( $persons as $person ) {
		echo "ID: {$person->id} \nNAME: {$person->name}\nCPF: {$person->cpf}\n\n";
	}

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

