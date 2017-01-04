<?php echo Html::script ('assets/libs/jquery.form.min.js'); ?>

<?php echo Html::script ('assets/js/forms.js'); ?>


<div class="row article">
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <p>
                    همیار گرامی؛
                    <br>
                    مشخصات شما در سامانه کشوری اهدای عضو ثبت گردیده است و این مشخصات در صورت بروز حادثه در تمامی بیمارستان های کشور قابل دسترسی می باشد.
                    <br>
                    می توانید جهت همراه داشتن کارت اهدای عضو خود از طریق دکمه چاپ کارت اقدام نمائید، همچنین می توانید با استفاده از دکمه دریافت کارت، کارت اهدای عضو خود را برروی کامپیوتر شخصی خود ذخیره نمائید.
                    <br>
                </p>
                <p class="text-center col-xs-12 col-md-8 col-md-offset-2">
                    <img src="<?php echo e(url('/card/show_card/mini/' . encrypt(Auth::user()->code_melli))); ?>" alt="<?php echo e(trans('site.know_menu.organ_donation_card')); ?>" class="ehda-card-image">

                    <?php echo $__env->make('forms.button', [
                        'shape' => 'info',
                        'link' => url('/card/show_card/full/' . encrypt(Auth::user()->code_melli) . '/download'),
                        'label' => trans('forms.button.card_save'),
                    ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <a class="btn btn-info" href="<?php echo e(url('/members/my_card/print')); ?>" target="_blank"><?php echo e(trans('forms.button.card_print')); ?></a>
                </p>
            </div>
        </div>
    </div>
</div>