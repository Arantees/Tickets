<?php

use Tickets\Http\Response;
use \Tickets\Controller\Admin;


//ROTA Admin
$obRouter->get('/admin', [
    function () {
        return new Response(200, 'Admin ;)');
    }
]);
//ROTA Login
$obRouter->get('/admin/login', [
    function ($request) {
        return new Response(200,Admin\Login::getLogin($request));
    }
]);
//ROTA Login post
$obRouter->post('/admin/login', [
    function ($request) {
        return new Response(200,Admin\Login::getLogin($request));
    }
]);

