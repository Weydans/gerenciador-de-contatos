<?php

use App\Domain\Service\ContactReadService;
use App\Domain\Repository\ContactDoctrineRepository;

require_once( 'vendor/autoload.php' );

try {
	$contactList = ContactReadService::execute( new ContactDoctrineRepository() );

	foreach( $contactList as $contact ) {
		echo "ID: {$contact->id} \nTYPE: {$contact->type}\nDESCRIPTION: {$contact->description}\n";
		echo "PERSON: {$contact->person->name}\n\n";
	}

} catch ( \Exception $e ) {
	
	$message = $_ENV['APP_DEBUG'] ? $e->getMessage() : 'Something went wrong';

	echo $message . PHP_EOL;
} 

