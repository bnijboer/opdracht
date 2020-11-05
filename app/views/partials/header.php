<!DOCTYPE html>
<html lang="en">
<head>
      <title>Exercise</title>
      <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    
<?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) : ?>
    <?= "Logged in as {$_SESSION['username']}"; ?>
<?php endif ?>

<nav>
    <ul>
        <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) : ?>
            <li><a href="/">Home</a></li>
            <li><a href="/file">Show Database</a></li>
            <li><a href="/write">Write Data to .csv</a></li>
            <li><a href="/logout">Logout</a></li>
        <?php else : ?>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>