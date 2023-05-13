<?php

use App\Controller\PersonController;
use App\Controller\ContactController;

$route = new Lib\Route( new Lib\Request() );

$route->get(    '/api/persons',     PersonController::class, 'read'   );
$route->post(   '/api/persons',     PersonController::class, 'create' );
$route->put(    '/api/persons/$id', PersonController::class, 'update' );
$route->delete( '/api/persons/$id', PersonController::class, 'delete' );

$route->get(    '/api/contacts',     ContactController::class, 'read'   );
$route->post(   '/api/contacts',     ContactController::class, 'create' );
$route->put(    '/api/contacts/$id', ContactController::class, 'update' );
$route->delete( '/api/contacts/$id', ContactController::class, 'delete' );
