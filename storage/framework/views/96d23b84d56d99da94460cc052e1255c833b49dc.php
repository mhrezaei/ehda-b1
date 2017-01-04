<?php echo $__env->make('forms.group-start' , [
    'label' => isset($domain)? $domain->title : trans('validation.attributes.global_value'),
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.check' , [
    'name' => isset($domain)? $domain->slug : 'global_value',
    'label' => ' ',
    'class' => isset($domain)? '' : 'form-default',
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('forms.group-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
