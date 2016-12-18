<?php echo $__env->make('forms.datepicker' , [
    'name' => isset($domain)? $domain->slug : 'global_value',
    'label' => isset($domain)? $domain->title : trans('validation.attributes.global_value'),
    'class' => isset($domain)? '' : 'form-default' ,
], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
