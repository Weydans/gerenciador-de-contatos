<?php

require_once( 'vendor/autoload.php' );

use App\Domain\Model\Factory\EntityManagerFactory;

$factory = new EntityManagerFactory();

var_dump( $factory->create() );

