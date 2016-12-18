<div class="row article">
    <div class="col-xs-12">
        <div class="container">
                <div class="row">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php if(sizeof($faq)): ?>
                            <?php foreach($faq as $post): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading<?php echo e($post->id); ?>">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo e($post->id); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($post->id); ?>">
                                                <?php echo App\Providers\AppServiceProvider::pd(($post->title)) ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?php echo e($post->id); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo e($post->id); ?>">
                                        <div class="panel-body">
                                            <?php echo $post->text; ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php echo $__env->make('site.faq.new_question', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>