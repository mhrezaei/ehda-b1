<?php if(strlen($static_paragraph['top']->title)): ?>
    <div class="row">
        <div id="current-members" class="text-center">
            <h3><?php echo App\Providers\AppServiceProvider::pd(($static_paragraph['top']->title)) ?></h3>
        </div>
    </div>
<?php endif; ?>