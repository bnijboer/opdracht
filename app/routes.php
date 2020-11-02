<?php


$router->get('', 'PagesController@home');
$router->get('login', 'PagesController@login');
$router->get('register', 'PagesController@register');

$router->post('register', 'AuthController@register');