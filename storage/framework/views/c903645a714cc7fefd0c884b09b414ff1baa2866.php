<?php echo Html::script ('assets/libs/jquery.form.min.js'); ?>

<?php echo Html::script ('assets/js/forms.js'); ?>


<div class="row article">
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <p style="text-align: justify;">
                <?php echo $volunteer->text; ?>

                    <?php if(Auth::check()): ?>
                        <?php if(Auth::user()->volunteer_status >= 3 or Auth::user()->volunteer_status < 0): ?>
                            <?php echo $__env->make('forms.button', [
                            'shape' => 'success',
                            'link' => url('/volunteers/exam'),
                            'label' => trans('site.global.volunteer_register_page'),
                            'extra' => 'disabled=disabled',
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php elseif(Auth::user()->volunteer_status == 2): ?>
                            <?php echo $__env->make('forms.button', [
                            'shape' => 'success',
                            'link' => url('/volunteers/final_step'),
                            'label' => trans('site.global.volunteer_complete_form'),
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php elseif(Auth::user()->volunteer_status == 1): ?>
                            <?php if(\Carbon\Carbon::parse(Auth::user()->exam_passed_at)->diffInHours(\Carbon\Carbon::now()) >= 24): ?>
                                <?php echo $__env->make('forms.button', [
                                'shape' => 'success',
                                'link' => url('/volunteers/exam'),
                                'label' => trans('site.global.volunteer_exam'),
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('forms.button', [
                                'shape' => 'success',
                                'link' => url('/volunteers/exam'),
                                'label' => 24 - \Carbon\Carbon::parse(Auth::user()->exam_passed_at)->diffInHours(\Carbon\Carbon::now()) . trans('site.global.volunteer_waiting_time_for_exam'),
                                'extra' => 'disabled=disabled',
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php echo $__env->make('forms.button', [
                            'shape' => 'success stepOneBtn',
                            'link' => 'volunteer_register_step_one("start")',
                            'label' => trans('site.global.volunteer_register_page')
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php echo $__env->make('forms.button', [
                        'shape' => 'success stepOneBtn',
                        'link' => 'volunteer_register_step_one("start")',
                        'label' => trans('site.global.volunteer_register_page')
                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>

                    <?php echo $__env->make('forms.button', [
                        'shape' => 'info pdf-book',
                        'link' => url('') . '/assets/files/safiran-learning.pdf',
                        'label' => trans('site.global.volunteer_resource_pdf'),
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </p>
            </div>
            <div class="col-xs-12 col-md-8 col-md-offset-2 stepOneForm">
                <?php echo Form::open([
                            'url'	=> 'volunteer/first_step' ,
                            'method'=> 'post',
                            'class' => 'clearfix js',
                            'name' => 'volunteer_form_step_one',
                            'id' => 'volunteer_form_step_one',
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
                            <label for="tel_mobile"><?php echo e(trans('validation.attributes.tel_mobile')); ?>: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-mobile form-required" id="tel_mobile" name="tel_mobile" data-toggle="tooltip" data-placement="top" placeholder="<?php echo e(trans('validation.attributes_placeholder.tel_mobile')); ?>" title="<?php echo e(trans('validation.attributes_example.tel_mobile')); ?>" minlength="11" maxlength="11" error-value="<?php echo e(trans('validation.javascript_validation.tel_mobile')); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="email"><?php echo e(trans('validation.attributes.email')); ?>: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-email form-required" id="email" name="email" data-toggle="tooltip" data-placement="top" placeholder="<?php echo e(trans('validation.attributes_placeholder.email')); ?>" title="<?php echo e(trans('validation.attributes_example.email')); ?>" error-value="<?php echo e(trans('validation.javascript_validation.email')); ?>">
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