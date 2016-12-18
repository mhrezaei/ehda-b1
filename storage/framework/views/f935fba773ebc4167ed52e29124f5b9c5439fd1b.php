<?php echo Html::script ('assets/libs/jquery.form.min.js'); ?>

<?php echo Html::script ('assets/js/forms.js'); ?>


<div class="row article">
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <p>
                <?php echo $post->text; ?>

                    <?php echo $__env->make('forms.button', [
                        'shape' => 'success stepOneBtn',
                        'link' => 'register_card_step_one("start")',
                        'label' => trans('site.global.card_register_page')
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </p>
            </div>
            <div class="col-xs-12 col-md-8 col-md-offset-2 stepOneForm">
                <?php echo Form::open([
                            'url'	=> 'register/first_step' ,
                            'method'=> 'post',
                            'class' => 'clearfix ehda-card-form js',
                            'name' => 'register_form_step_one',
                            'id' => 'register_form_step_one',
                        ]); ?>


                <div class="form-group">
                    <div>اطلاعات فردی</div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="name_first"><?php echo e(trans('validation.attributes.name_first')); ?>: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-persian form-required" id="name_first" name="name_first" data-toggle="tooltip" data-placement="top" placeholder="<?php echo e(trans('validation.attributes_placeholder.name_first')); ?>" title="<?php echo e(trans('validation.attributes_example.name_first')); ?>" minlength="2" error-value="<?php echo e(trans('validation.javascript_validation.name_first')); ?>">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="name_last"><?php echo e(trans('validation.attributes.name_last')); ?>: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-persian form-required" id="name_last" name="name_last" data-toggle="tooltip" data-placement="top" placeholder="<?php echo e(trans('validation.attributes_placeholder.name_last')); ?>" title="<?php echo e(trans('validation.attributes_example.name_last')); ?>" minlength="2" error-value="<?php echo e(trans('validation.javascript_validation.name_last')); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="code_melli"><?php echo e(trans('validation.attributes.code_melli')); ?>: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-national form-required" id="code_melli" name="code_melli" data-toggle="tooltip" data-placement="top" placeholder="<?php echo e(trans('validation.attributes_placeholder.code_melli')); ?>" title="<?php echo e(trans('validation.attributes_example.code_melli')); ?>" minlength="10" maxlength="10" error-value="<?php echo e(trans('validation.javascript_validation.code_melli')); ?>">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="security"><?php echo e($captcha['question']); ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-number form-required" id="security" name="security" data-toggle="tooltip" data-placement="top" placeholder="<?php echo e(trans('validation.attributes_placeholder.security')); ?>" title="<?php echo e(trans('validation.attributes_example.security')); ?>" minlength="1" error-value="<?php echo e(trans('validation.javascript_validation.security')); ?>">
                            <input type="hidden" name="key" value="<?php echo e($captcha['key']); ?>">
                        </div>
                    </div>
                </div>
                <?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <p>
                    <?php echo $__env->make('forms.button', [
                        'shape' => 'success',
                        'label' => trans('forms.button.send'),
                        'type' => 'submit',
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php echo $__env->make('forms.button', [
                        'shape' => 'warning',
                        'link' => 'register_card_step_one("stop")',
                        'label' => trans('forms.button.cancel'),
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </p>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>