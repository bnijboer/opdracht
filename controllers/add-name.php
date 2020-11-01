<?php

$users = App::get('database')->insert('users', [
    'username' => $_POST['username'],
    'password' => $_POST['password']
]);

header('Location: /');