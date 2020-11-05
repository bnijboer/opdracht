<?php require('partials/header.php') ?>

<?php if (! empty($data)) : ?>
    <form action="/update" method="POST">
        <div>
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <?php foreach($row as $header => $column) : ?>
                        <?= "<th>{$header}</th>" ?>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach($row as $columnKey => $columnValue) : ?>
                        <td>
                            <input type="text" name="<?= $columnKey; ?>" value="<?= $columnValue; ?>">
                        </td>
                    <?php endforeach; ?> 
                </tr>
            </table>
            <button type="submit">Update</button>
        </div>
    </form>
    
<?php endif; ?>

<?php require('partials/footer.php') ?>