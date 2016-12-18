<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingqs">
        <h4 class="panel-title">
            <a class="collapsed" style="color: #1F398B;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseqs" aria-expanded="false" aria-controls="collapseqs">
                <span class="glyphicon glyphicon-pencil"></span> <?php echo e(trans('site.global.new_faq_qs')); ?>

            </a>
        </h4>
    </div>
    <div id="collapseqs" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingqs">
        <div class="panel-body">
            <div class="row">
                <?php
                    if (Auth::check())
                        {
                            $full_name = Auth::user()->name_first . ' ' . Auth::user()->name_last;
                            $email = Auth::user()->email;
                            $tel_mobile = Auth::user()->tel_mobile;
                        }
                        else
                        {
                            $full_name = '';
                            $email = '';
                            $tel_mobile = '';
                        }
                ?>
            <?php echo Form::open([
                'url'	=> '/faq/new' ,
                'method'=> 'post',
                'class' => 'clearfix ehda-card-form js',
                'name' => 'new_faq_qs',
                'id' => 'new_faq_qs',
            ]); ?>


            <div class="col-xs-12 col-sm-6">
                <?php echo $__env->make('forms_site.input', [
                'field' => 'full_name',
                'min' => 2,
                'class' => 'form-persian form-required',
                'required' => 1,
                'value' => $full_name,
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-xs-12 col-sm-6">
                <?php echo $__env->make('forms_site.input', [
                'field' => 'email',
                'class' => 'form-email form-required',
                'required' => 1,
                'value' => $email,
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-xs-12 col-sm-6">
                <?php echo $__env->make('forms_site.input', [
                'field' => 'tel_mobile',
                'min' => 11,
                'max' => 11,
                'class' => 'form-mobile',
                'value' => $tel_mobile,
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-xs-12 col-sm-6">
                <?php echo $__env->make('forms_site.input', [
                'field' => 'title',
                'class' => 'form-persian',
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-xs-12 col-sm-12">
                <?php echo $__env->make('forms_site.textarea', [
                'field' => 'text',
                'class' => 'form-persian form-required',
                'min' => 10,
                'required' => 1,
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div style="clear: both;"></div>
            <div class="form-group" style="width: 50%; margin: 0 auto;">
                <?php echo $__env->make('forms.feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div style="clear: both;"></div>
            <div class="form-group text-center">
                <?php echo $__env->make('forms.button', [
                    'shape' => 'success step_one_btn',
                    'label' => trans('forms.button.send'),
                    'type' => 'submit',
                ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <?php echo Form::close(); ?>

        </div>
        </div>
    </div>
</div>
<?php echo Html::script ('assets/libs/jquery.form.min.js'); ?>

<?php echo Html::script ('assets/js/forms.js'); ?>