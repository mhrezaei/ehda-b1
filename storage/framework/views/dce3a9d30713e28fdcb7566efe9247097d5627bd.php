<div class="row">
    <div class="page-green-title col-xs-12">
        <h3 class="container">
            <?php if(isset($category)): ?>
                <?php /*<?php echo App\Providers\AppServiceProvider::pd(($category)) ?>*/ ?>
                <?php echo e($category); ?>

            <?php endif; ?>
        </h3>
    </div>
    <div class="col-xs-12">
        <div class="container">
            <h2 class="text-success">
                <?php if(isset($parent)): ?>
                    <?php /*<?php echo App\Providers\AppServiceProvider::pd(($parent)) ?>*/ ?>
                    <?php echo e($parent); ?>

                <?php endif; ?>
            </h2>
            <h3 class="sub-title">
                <?php if(isset($sub)): ?>
                    <?php /*<?php echo App\Providers\AppServiceProvider::pd(($sub)) ?>*/ ?>
                    <?php echo e($sub); ?>

                <?php endif; ?>
            </h3>
        </div>
    </div>
</div>