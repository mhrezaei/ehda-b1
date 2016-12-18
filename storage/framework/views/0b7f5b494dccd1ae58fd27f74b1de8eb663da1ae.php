<?php echo Html::script ('assets/site/js/persian-date-0.1.8.min.js'); ?>

<?php echo Html::script ('assets/site/js/persian-datepicker-0.4.5.min.js'); ?>

<?php echo Html::script ('assets/libs/jquery.form.min.js'); ?>

<?php echo Html::script ('assets/js/forms.js'); ?>


<?php echo Html::style('assets/libs/bootstrap-select/bootstrap-select.min.css'); ?>

<?php echo HTML::script ('assets/libs/bootstrap-select/bootstrap-select.min.js'); ?>

<?php echo HTML::script ('assets/libs/bootstrap-select/defaults-fa_IR.min.js'); ?>



<div class="row">
    <div class="col-xs-12">
        <div class="container">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="row">
                    <?php echo Form::open([
                        'url'	=> '/volunteers/final_step/submit' ,
                        'method'=> 'post',
                        'class' => 'clearfix ehda-card-form js',
                        'name' => 'volunteer_final_step',
                        'id' => 'volunteer_final_step',
                    ]); ?>


                    <?php echo $__env->make('forms_site.form_separator', [
                        'title' => trans('site.global.personal_data')
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'name_first',
                            'min' => 2,
                            'class' => 'form-persian form-required',
                            'required' => 1,
                            'value' => $user->name_first
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'name_last',
                            'min' => 2,
                            'class' => 'form-persian form-required',
                            'required' => 1,
                            'value' => $user->name_last
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.select_gender', [
                                'field' => 'gender',
                                'class' => 'form-select form-required',
                                'required' => 1,
                                'value' => $user->name_last
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'name_father',
                            'min' => 2,
                            'class' => 'form-persian form-required',
                            'required' => 1,
                            'value' => $user->name_father
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'code_id',
                            'min' => 1,
                            'max' => 10,
                            'class' => 'form-number form-required',
                            'required' => 1,
                            'value' => $user->code_id
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'code_melli',
                            'min' => 10,
                            'max' => 10,
                            'class' => 'form-national form-required',
                            'required' => 1,
                            'value' => $user->code_melli,
                            'attr' => 'readonly'
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'birth_date',
                            'class' => 'form-datepicker form-required',
                            'required' => 1,
                            'attr' => 'autocomplete=off',
                            'value' => $user->birth_date ? jDate::forge($user->birth_date)->format('Y/m/d') : ''
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.select_city' , [
                            'field' => 'birth_city' ,
                            'blank_value' => '0' ,
                            'options' => $states ,
                            'search' => true ,
                            'required' => 1,
                            'class' => 'form-selectpicker form-required',
                            'value' => $user->birth_city
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.select_marital', [
                                'field' => 'marital',
                                'class' => 'form-select form-required',
                                'required' => 1,
                                'value' => $user->marital
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'email',
                            'class' => 'form-email form-required',
                            'required' => 1,
                            'value' => $user->email
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <?php echo $__env->make('forms_site.form_separator', [
                        'title' => trans('site.global.edu_detail')
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.select_edu_level', [
                                'field' => 'edu_level',
                                'class' => 'form-select form-required',
                                'required' => 1,
                                'value' => $user->edu_level
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'edu_field',
                            'class' => 'form-persian form-required',
                            'required' => 1,
                            'value' => $user->edu_field
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.select_city' , [
                            'field' => 'edu_city' ,
                            'blank_value' => '0' ,
                            'options' => $states ,
                            'search' => true ,
                            'required' => 1,
                            'class' => 'form-selectpicker form-required',
                            'value' => $user->edu_city
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">

                        </div>
                    </div>

                    <?php echo $__env->make('forms_site.form_separator', [
                        'title' => trans('site.global.contact_detail')
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'tel_mobile',
                            'min' => 11,
                            'max' => 11,
                            'class' => 'form-mobile form-required',
                            'required' => 1,
                            'value' => $user->tel_mobile
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'tel_emergency',
                            'min' => 11,
                            'max' => 11,
                            'class' => 'form-phone form-required',
                            'required' => 1,
                            'value' => $user->tel_emergency
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <?php echo $__env->make('forms_site.form_separator', [
                        'title' => trans('site.global.home_contact_detail')
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.select_city' , [
                            'field' => 'home_city' ,
                            'blank_value' => '0' ,
                            'options' => $states ,
                            'search' => true ,
                            'required' => 1,
                            'class' => 'form-selectpicker form-required',
                            'value' => $user->home_city
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'home_address',
                            'class' => 'form-persian form-required',
                            'required' => 1,
                            'value' => $user->home_address
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'home_tel',
                            'min' => 11,
                            'max' => 11,
                            'class' => 'form-phone form-required',
                            'required' => 1,
                            'value' => $user->home_tel
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'home_postal_code',
                            'min' => 10,
                            'max' => 10,
                            'class' => 'form-number',
                            'value' => $user->home_postal_code
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <?php echo $__env->make('forms_site.form_separator', [
                        'title' => trans('site.global.work_contact_detail')
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'job',
                            'min' => 2,
                            'class' => 'form-persian  form-required',
                            'required' => 1,
                            'value' => $user->job
                             ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.select_city' , [
                            'field' => 'work_city' ,
                            'blank_value' => '0' ,
                            'options' => $states ,
                            'search' => true ,
                            'class' => 'form-selectpicker',
                            'value' => $user->work_city
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'work_address',
                            'class' => 'form-persian',
                            'value' => $user->work_address
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'work_tel',
                            'min' => 11,
                            'max' => 11,
                            'class' => 'form-phone',
                            'value' => $user->work_tel
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'work_postal_code',
                            'min' => 10,
                            'max' => 10,
                            'class' => 'form-number',
                            'value' => $user->work_postal_code
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">

                        </div>
                    </div>

                    <?php echo $__env->make('forms_site.form_separator', [
                        'title' => trans('site.global.additional_data')
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.select_familization', [
                                'field' => 'familization',
                                'class' => 'form-select form-required',
                                'required' => 1,
                                'value' => $user->familization
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'motivation',
                            'class' => 'form-persian',
                            'required' => 1,
                            'value' => $user->motivation
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <?php echo $__env->make('forms_site.input', [
                            'field' => 'alloc_time',
                            'class' => 'form-persian form-required',
                            'required' => 1,
                            'value' => $user->alloc_time
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">

                        </div>
                    </div>

                    <?php echo $__env->make('forms_site.form_separator', [
                        'title' => trans('site.global.your_activity')
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <?php echo $__env->make('forms_site.activity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>

                    <?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="form-group text-center">
                        <?php echo $__env->make('forms.button', [
                            'shape' => 'success step_one_btn',
                            'label' => trans('forms.button.send'),
                            'type' => 'submit',
                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('forms.button', [
                            'shape' => 'warning step_one_btn',
                            'label' => trans('forms.button.cancel'),
                            'type' => 'button',
                            'link' => url(''),
                        ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </div>
</div>