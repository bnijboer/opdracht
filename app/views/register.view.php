<?php require('partials/header.php') ?>

<h1>Register</h1>

<form action="/register" method="POST">

    <div>
        <label for="username">Username</label>
        <input name="username" type="text">
    </div>
    <div>
        <label for="password">Password</label>
        <input name="password" type="password">
    </div>
    <div>
        <button type="submit">Register</button>
    </div>
    
</form>

<?php require('partials/footer.php') ?>