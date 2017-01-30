<footer class="bg-primary" style="padding-bottom: 40px;">
    <div class="container">
        <div class="row">
            <?php echo $__env->make('site.frame.footer_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="col-xs-12 col-md-8">
                <?php echo $__env->make('site.frame.footer_social_network', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('site.frame.footer_contact_info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="row" style="text-align: center; color: #FFFAAA; font-size: 12px; padding-top: 20px;">
            <a href="https://yasnateam.com" target="_blank" style="color: #FFFAAA;">طراحی و اجرا: گروه یسنا</a>
        </div>
    </div>
</footer>
<?php echo Html::script ('assets/site/js/main.js'); ?>

</body>
</html>