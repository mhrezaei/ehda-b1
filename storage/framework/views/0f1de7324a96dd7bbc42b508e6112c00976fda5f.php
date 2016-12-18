<div class="row" id="home-notes">
    <?php echo $__env->make('site.home.animated_stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('site.home.circle_stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>