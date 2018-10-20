<?=$breadcrumbs->breadcrumbs; ?>
<hr>
<?php if ($products) : ?>
    <?php foreach ($products as $product) { ?>
        <h3><a href="/product/<?= $product->id; ?>"><?= $product->title; ?></a></h3>
    <?php } ?>

    <?= $pagination; ?>
<?php else : ?>
    <p>Empty!!!</p>
<?php endif; ?>