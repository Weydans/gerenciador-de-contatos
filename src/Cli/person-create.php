<?php

use App\Domain\Model\Person;
use App\Domain\Repository\PersonRepository;

require_once( 'vendor/autoload.php' );

if ( $argc != 3 ) {
	echo "Usage: {$argv[0]} <name> <cpf>" . PHP_EOL;
	exit();
}

$person = new Person( $argv[1], $argv[2] );

$repository = new PersonRepository();
$repository->create( $person );

