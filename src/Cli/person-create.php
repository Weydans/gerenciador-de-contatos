<?php

use App\Domain\Service\PersonCreateService;
use App\Domain\Repository\PersonDoctrineRepository;

require_once( 'vendor/autoload.php' );

if ( $argc != 3 ) {
	echo "Usage: {$argv[0]} <name> <cpf>" . PHP_EOL;
	exit();
}

try {
	$personDto = (object) [
		'name' => $argv[1], 
		'cpf'  => $argv[2],
	]; 

	PersonCreateService::execute( $personDto, new PersonDoctrineRepository() );

	echo "Person created with success" . PHP_EOL;

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

