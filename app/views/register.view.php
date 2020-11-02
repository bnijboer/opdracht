<?php require('partials/header.php') ?>

<h1>Sign Up</h1>

<form method="POST" action="/register">

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