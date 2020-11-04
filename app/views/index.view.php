<?php require('partials/header.php') ?>

<form enctype="multipart/form-data" action="/upload" method="POST">
    <input type="file" name="csvfile">
    <button type="submit">Submit</button>
</form>

<?php require('partials/footer.php') ?>