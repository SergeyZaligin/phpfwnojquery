<li>
    <div class="comment-content">
        <div class="comment-meta">
            <span><?=h($item['comment_author']); ?></span>
            <span><?=h($item['created']); ?></span>
            
        </div>
        <div class="comment-text">
            <p><?= nl2br(h($item['comment_text'])); ?></p>
            <span data="<?= $item['comment_id']; ?>" class="comment-open-btn reply" >Ответить</span>
        </div>
        
        <?php if(isset($item['childs'])): ?>
            <ul class="comment-child">
                <?= self::getMenuHtml($item['childs']);?>
            </ul>
        <?php endif; ?>
    </div>
</li>
