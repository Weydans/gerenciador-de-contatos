<?php

use App\Domain\Repository\PersonRepository;
use App\Domain\Exception\PersonNotFoundException;

require_once( 'vendor/autoload.php' );

if ( $argc != 4 ) {
	echo "Usage: {$argv[0]} <id> <name> <cpf>" . PHP_EOL;
	exit();
}

try {
	$repository = new PersonRepository();

	$person = $repository->find( $argv[1] );

	$person->name = $argv[ 2 ];
	$person->cpf = $argv[ 3 ];
	
	$repository->save();

} catch ( PersonNotFoundException $e ) {
	echo $e->getMessage() . PHP_EOL;

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

