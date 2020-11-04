<?php require('partials/header.php') ?>

<table>
    <thead>
        <tr>
            <?php foreach(array_keys($data[0]) as $columnHeader) : ?>
                <?= "<th>{$columnHeader}</th>" ?>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $row) : ?>
            <?= '<tr>' ?>
            
            <?php foreach($row as $column) : ?>
                <?= "<td>{$column}</td>" ?>
            <?php endforeach ?>
            
            <?= '</tr>' ?>
        <?php endforeach ?>
    </tbody>
</table>


<?php require('partials/footer.php') ?>