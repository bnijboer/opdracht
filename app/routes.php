<?php


$router->get('', 'PagesController@home');
$router->get('login', 'PagesController@login');
$router->get('register', 'PagesController@register');

$router->post('register', 'AuthController@register');
$router->post('login', 'AuthController@login');
$router->get('logout', 'AuthController@logout');

$router->post('upload', 'FileController@store');
$router->get('file', 'FileController@show');

$router->post('edit', 'RowController@edit');
$router->post('update', 'RowController@update');