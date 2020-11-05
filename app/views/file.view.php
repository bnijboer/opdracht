<?php require('partials/header.php') ?>

<table cellspacing="0" cellpadding="0">
    <tr>
        <?php foreach(array_keys($data[0]) as $columnHeader) : ?>
            <th>
                <?= $columnHeader ?>
            </th>
        <?php endforeach; ?>
    </tr>
    <?php foreach($data as $row) : ?>
            <form action="/edit" method="POST">
                <tr>
                    <?php foreach($row as $columnKey => $columnValue) : ?>
                        <?php if($columnKey === 'id') : ?>
                            <td>
                                <input type="hidden" name="rowId" value="<?= $row['id'] ?>">
                                <button type="submit">Edit Row <?= $row['id']; ?></button>
                            </td>
                        <?php else : ?>
                            <td>
                                <?= $columnValue; ?>
                            </td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            </form>
    <?php endforeach; ?>
</table>


<?php require('partials/footer.php') ?>