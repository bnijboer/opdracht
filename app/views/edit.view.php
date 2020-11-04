<?php require('partials/header.php') ?>

<?php if (! empty($data)) : ?>
    <form action="/update" method="POST">
        <table>
            <thead>
                <tr>
                    <?php foreach($row as $header => $column) : ?>
                        <?= "<th>{$header}</th>" ?>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach($row as $columnKey => $columnValue) : ?>
                        <td>
                            <input type="text" name="<?= $columnKey; ?>" value="<?= $columnValue; ?>">
                        </td>
                    <?php endforeach; ?> 
                </tr>
            </tbody>
        </table>
        <button type="submit">Update</button>
    </form>
    
    
<?php endif; ?>

<?php require('partials/footer.php') ?>