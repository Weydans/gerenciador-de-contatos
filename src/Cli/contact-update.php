<?php

use App\Domain\Service\ContactUpdateService;
use App\Domain\Exception\RegisterNotFoundException;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;

require_once( 'vendor/autoload.php' );

if ( $argc != 5 ) {
	echo "Usage: {$argv[0]} <id> <type> <description> <personId>" . PHP_EOL;
	exit();
}

try {
	$personDto = (object) [
		'id'          => $argv[1], 
		'type'        => $argv[2], 
		'description' => $argv[3],
		'personId'    => $argv[4],
	]; 

	ContactUpdateService::execute( 
		$personDto, 
		new ContactDoctrineRepository(),
		new PersonDoctrineRepository()
	);

	echo "Contact updated with success" . PHP_EOL;

} catch ( RegisterNotFoundException $e ) {
	echo $e->getMessage() . PHP_EOL;

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

