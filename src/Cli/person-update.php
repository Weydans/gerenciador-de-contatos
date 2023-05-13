<?php

use App\Domain\Service\PersonUpdateService;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Exception\PersonNotFoundException;

require_once( 'vendor/autoload.php' );

if ( $argc != 4 ) {
	echo "Usage: {$argv[0]} <id> <name> <cpf>" . PHP_EOL;
	exit();
}

try {
	$personDto = (object) [
		'id'   => $argv[1], 
		'name' => $argv[2], 
		'cpf'  => $argv[3],
	]; 

	PersonUpdateService::execute( $personDto, new PersonDoctrineRepository() );

	echo "Person updated with success" . PHP_EOL;

} catch ( PersonNotFoundException $e ) {
	echo $e->getMessage() . PHP_EOL;

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

