<?php echo Form::open([
    'url'	=> '/register/register_third_step' ,
    'method'=> 'post',
    'class' => 'clearfix ehda-card-form js',
    'name' => 'register_third_step',
    'id' => 'register_third_step',
    'style' => 'display: none;'
]); ?>


<?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="form-group text-center">
    <button type="submit" class="btn btn-link submit">
        <img src="<?php echo e(url('')); ?>/assets/site/images/form-submit.png" width="190" height="190">
    </button>
    <div style="clear: both; margin-top: 15px;"></div>
    <input type="hidden" name="db-check" id="db-check" value="null">
    <button type="button" class="btn btn-db-check"><?php echo e(trans('forms.button.oh_no')); ?></button>
</div>

<?php echo Form::close(); ?>