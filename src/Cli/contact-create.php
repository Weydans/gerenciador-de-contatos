<?php

use App\Domain\Service\ContactCreateService;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;

require_once( 'vendor/autoload.php' );

if ( $argc != 4 ) {
	echo "Usage: {$argv[0]} <type> <description> <personId>" . PHP_EOL;
	exit();
}

try {
	$personDto = (object) [
		'type'        => $argv[1], 
		'description' => $argv[2],
		'personId'    => $argv[3],		
	]; 

	ContactCreateService::execute( 
		$personDto, 
		new ContactDoctrineRepository(), 
		new PersonDoctrineRepository() 
	);

	echo "Contact created with success" . PHP_EOL;

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

