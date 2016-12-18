<?php echo Html::script ('assets/libs/jquery.form.min.js'); ?>

<?php echo Html::script ('assets/js/forms.js'); ?>


<div class="row article">
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                    <?php echo Form::open([
                            'url'	=> 'volunteer/second_step' ,
                            'method'=> 'post',
                            'class' => 'clearfix js',
                            'name' => 'volunteer_form_step_second',
                            'id' => 'volunteer_form_step_second',
                        ]); ?>


                    <div class="form-group" style="margin-bottom: 40px; color: #0f0f0f;">
                        <div><?php echo e(trans('site.global.volunteer_exam_detail')); ?></div>
                    </div>

                    <?php foreach($tests as $key => $test): ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <?php echo App\Providers\AppServiceProvider::pd(($key+1)) ?>- <?php echo $test['question']; ?>

                                    <div style="width: 90%; color: #002166; margin: 0 auto;">
                                        <?php foreach($test['options'] as $k => $answer): ?>
                                            <?php echo $__env->make('site.volunteers.volunteers_exam.exam_radio_form', [
                                            'id' => $test['id'],
                                            'value' => encrypt($answer[1]),
                                            'label' => trans('forms.alphabet.' . $k),
                                            'title' => $answer[0]
                                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <hr style="background-color: #0A3C6E;">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <p id="exam_count" class="hide-element"><?php echo e(trans('site.global.volunteer_exam_count')); ?></p>

                    <?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('forms.button', [
                        'shape' => 'primary',
                        'label' => trans('site.global.volunteer_db_check_send_sheet'),
                        'type' => 'submit',
                        'class' => 'hide-element',
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php echo $__env->make('forms.button', [
                        'shape' => 'success',
                        'label' => trans('forms.button.send_answer_sheet'),
                        'type' => 'button',
                        'link' => 'volunteer_send_sheet(this)'
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>