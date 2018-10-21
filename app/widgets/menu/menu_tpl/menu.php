<?php if(isset($category['childs'])): ?>
<li class="parent-li">
<?php else : ?>
<li>
<?php endif; ?>
    <a href="/category/<?=$id;?>" title="<?=$category['title'];?>"><?=$category['title'];?></a>
    <?php if(isset($category['childs'])): ?>
        <ul>
            <?= $this->getMenuHtml($category['childs']);?>
        </ul>
    <?php endif; ?>
</li>