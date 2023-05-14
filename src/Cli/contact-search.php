<?php

use App\Domain\Service\ContactSearchService;
use App\Domain\Repository\ContactDoctrineRepository;

require_once( 'vendor/autoload.php' );

if ( $argc != 3 ) {
	echo "Usage: {$argv[0]} <field> <value>" . PHP_EOL;
	exit();
}

try {
	$contacts = ContactSearchService::execute( 
		$argv[1], 
		$argv[2], 
		new ContactDoctrineRepository() 
	);
	
	foreach ( $contacts as $contact ) {
		echo "ID: {$contact->id} \nTYPE: {$contact->type}\nDESCRIPTION: {$contact->description}\n";
		echo "PERSON: {$contact->person->name}\n\n";
	}

} catch ( \Exception $e ) {
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

