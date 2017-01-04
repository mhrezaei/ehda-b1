<div class="row">
    <div class="page-green-title col-xs-12">
        <h3 class="container">
            <?php if(isset($category)): ?>
                <?php echo App\Providers\AppServiceProvider::pd(($category)) ?>
            <?php endif; ?>
        </h3>
    </div>
    <div class="col-xs-12">
        <div class="container">
            <h2 class="text-success">
                <?php if(isset($parent)): ?>
                    <?php echo App\Providers\AppServiceProvider::pd(($parent)) ?>
                <?php endif; ?>
            </h2>
            <h3 class="sub-title">
                <?php if(isset($sub)): ?>
                    <?php echo App\Providers\AppServiceProvider::pd(($sub)) ?>
                <?php endif; ?>
            </h3>
        </div>
    </div>
</div>