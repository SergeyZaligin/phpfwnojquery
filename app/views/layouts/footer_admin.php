<?php if (isset($_SESSION['validate_errors'])): ?>
    <div class="errors-validate">
        <?=$_SESSION['validate_errors']; unset($_SESSION['validate_errors']); ?>
    </div>
    <?php  elseif (isset($_SESSION['validate_success'])) : ?>
    <div class="success-validate"><?=$_SESSION['validate_success']; unset($_SESSION['validate_success']); ?></div>
<?php endif; ?>
    
<footer id="footer" role="contentinfo">Footer</footer>

</div>
  
<script async src="/js/main.min.js"></script>
<?php 
    foreach ($scripts as $script) {
        echo $script;
    }
?>

</body>
</html>
