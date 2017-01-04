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
                <div class="row text-center">
                    <img src="<?php echo e(url('')); ?>/assets/site/images/card.png" alt="<?php echo e(trans('site.know_menu.organ_donation_card')); ?>" class="ehda-card-image">
                </div>
                <div class="row">
                    <?php echo Form::open([
                        'url'	=> '/members/my_card/edit_process' ,
                        'method'=> 'post',
                        'class' => 'clearfix ehda-card-form js',
                        'name' => 'editForm',
                        'id' => 'editForm',
                    ]); ?>


                        <div class="form-group">
                            <div><?php echo e(trans('site.global.personal_data')); ?></div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'name_first',
                                'min' => 2,
                                'class' => 'form-persian form-required',
                                'required' => 1,
                                'value' => Auth::user()->name_first,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'name_last',
                                'min' => 2,
                                'class' => 'form-persian form-required',
                                'required' => 1,
                                'value' => Auth::user()->name_last,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.select_gender', [
                                    'field' => 'gender',
                                    'class' => 'form-select form-required',
                                    'required' => 1,
                                    'value' => Auth::user()->gender,
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'name_father',
                                'min' => 2,
                                'class' => 'form-persian form-required',
                                'required' => 1,
                                'value' => Auth::user()->name_father,
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
                                'value' => Auth::user()->code_id,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'code_melli',
                                'min' => 10,
                                'max' => 10,
                                'class' => 'form-national form-required',
                                'required' => 1,
                                'value' => Auth::user()->code_melli,
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
                                    'value' => jDate::forge(Auth::user()->birth_date)->format('Y/m/d')
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
                                'value' => Auth::user()->birth_city,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.select_edu_level', [
                                    'field' => 'edu_level',
                                    'class' => 'form-select form-required',
                                    'required' => 1,
                                    'value' => Auth::user()->edu_level,
                                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'job',
                                'min' => 2,
                                'class' => 'form-persian form-required',
                                'required' => 1,
                                'value' => Auth::user()->job,
                                 ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div><?php echo e(trans('site.global.contact_detail')); ?></div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'tel_mobile',
                                'min' => 11,
                                'max' => 11,
                                'class' => 'form-mobile form-required',
                                'required' => 1,
                                'value' => Auth::user()->tel_mobile,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'home_tel',
                                'min' => 11,
                                'max' => 11,
                                'class' => 'form-phone form-required',
                                'required' => 1,
                                'value' => Auth::user()->home_tel,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.select_city' , [
                                'field' => 'home_city' ,
                                'blank_value' => '0' ,
                                'options' => $states ,
                                'search' => true ,
                                'required' => 1,
                                'class' => 'form-selectpicker form-required',
                                'value' => Auth::user()->home_city,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'email',
                                'class' => 'form-email form-required',
                                'required' => 1,
                                'value' => Auth::user()->email,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div><?php echo e(trans('site.global.login_information_data')); ?></div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'password',
                                'class' => 'form-password',
                                'type' => 'password',
                                'min' => 8,
                                'max' => 64,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <span style="color: dimgray; font-size: 10px; line-height: 0px;">درصورت تکمیل جایگزین رمز قبلی میگردد.</span>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <?php echo $__env->make('forms_site.input', [
                                'field' => 'password2',
                                'type' => 'password',
                                'min' => 8,
                                'max' => 64,
                                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>

                    <?php echo $__env->make('forms_site.organs_checkbox', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <div class="form-group text-center">
                            <?php echo $__env->make('forms.button', [
                                'shape' => 'success step_one_btn',
                                'label' => trans('forms.button.save'),
                                'type' => 'submit',
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php echo $__env->make('forms.button', [
                                'shape' => 'warning step_one_btn',
                                'label' => trans('forms.button.cancel'),
                                'type' => 'button',
                                'link' => url('/members/my_card'),
                            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </div>
</div>