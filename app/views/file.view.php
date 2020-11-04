<?php require('partials/header.php') ?>

<?php if (! empty($data)) : ?>
    <table>
        <thead>
            <tr>
                <?php foreach(array_keys($data[0]) as $columnHeader) : ?>
                    <?= "<th>{$columnHeader}</th>" ?>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $row) : ?>
                    <form action="/edit" method="POST">
                        <tr>
                            <?php foreach($row as $column) : ?>
                                <td>
                                    <?= $column; ?>
                                </td>
                            <?php endforeach; ?>
                            <td>
                                <input type="hidden" name="rowId" value="<?= $row['id'] ?>">
                                <button type="submit">Edit Row</button>
                            </td>
                        </tr>
                    </form>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


<?php require('partials/footer.php') ?>