<?php

use App\Http\Controller\PersonController;
use App\Http\Controller\ContactController;

$route = new Lib\Route( new Lib\Request() );

$route->get(    '/api/v0/persons',     PersonController::class, 'read'   );
$route->post(   '/api/v0/persons',     PersonController::class, 'create' );
$route->get(    '/api/v0/persons/$id', PersonController::class, 'show'   );
$route->put(    '/api/v0/persons/$id', PersonController::class, 'update' );
$route->delete( '/api/v0/persons/$id', PersonController::class, 'delete' );

$route->get(    '/api/v0/contacts',     ContactController::class, 'read'   );
$route->post(   '/api/v0/contacts',     ContactController::class, 'create' );
$route->get(    '/api/v0/contacts/$id', ContactController::class, 'show'   );
$route->put(    '/api/v0/contacts/$id', ContactController::class, 'update' );
$route->delete( '/api/v0/contacts/$id', ContactController::class, 'delete' );
