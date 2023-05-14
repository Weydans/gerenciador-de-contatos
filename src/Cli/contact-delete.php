<?php

use App\Domain\Service\ContactDeleteService;
use App\Domain\Exception\RegisterNotFoundException;
use App\Domain\Repository\ContactDoctrineRepository;

require_once( 'vendor/autoload.php' );

if ( $argc != 2 ) {
	echo "Usage: {$argv[0]} <id>" . PHP_EOL;
	exit();
}

try {
	ContactDeleteService::execute( $argv[1], new ContactDoctrineRepository() );

	echo "Contact deleted with success" . PHP_EOL;

} catch ( RegisterNotFoundException $e ) {
	echo $e->getMessage() . PHP_EOL;

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

