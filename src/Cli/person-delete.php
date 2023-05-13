<?php

use App\Domain\Repository\PersonRepository;
use App\Domain\Exception\PersonNotFoundException;

require_once( 'vendor/autoload.php' );

if ( $argc != 2 ) {
	echo "Usage: {$argv[0]} <id>" . PHP_EOL;
	exit();
}

try {
	$repository = new PersonRepository();
	$repository->delete( $argv[1] );

} catch ( PersonNotFoundException $e ) {
	echo $e->getMessage() . PHP_EOL;

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

