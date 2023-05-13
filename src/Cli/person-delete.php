<?php

use App\Domain\Service\PersonDeleteService;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Exception\PersonNotFoundException;

require_once( 'vendor/autoload.php' );

if ( $argc != 2 ) {
	echo "Usage: {$argv[0]} <id>" . PHP_EOL;
	exit();
}

try {
	PersonDeleteService::execute( $argv[1], new PersonDoctrineRepository() );

	echo "Person deleted with success" . PHP_EOL;

} catch ( PersonNotFoundException $e ) {
	echo $e->getMessage() . PHP_EOL;

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

