<div class="tags col-xs-12 col-sm-6">
    <?php if($post->meta('source')): ?>
        <a class="btn btn-sm btn-primary" target="_blank" href="<?php echo e($post->meta('source')); ?>"><?php echo e(trans('validation.attributes.source')); ?></a>
    <?php endif; ?>
    <?php if(sizeof($post->getKeywords())): ?>
        <?php echo e(trans('validation.attributes.keywords')); ?>:
        <?php foreach($post->getKeywords() as $keyword): ?>
            <a class="btn btn-sm btn-info" href="<?php echo e(url("/tags/" . urlencode($keyword))); ?>"><?php echo e($keyword); ?></a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>