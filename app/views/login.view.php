<?php require('partials/header.php') ?>

<h1>Sign In</h1>

<form method="POST" action="/login">

    <div>
        <label for="username">Username</label>
        <input name="username" type="text">
    </div>
    <div>
        <label for="password">Password</label>
        <input name="password" type="password">
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
    
</form>

<?php require('partials/footer.php') ?>