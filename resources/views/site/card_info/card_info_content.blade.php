{!! Html::script ('assets/libs/jquery.form.min.js') !!}
{!! Html::script ('assets/js/forms.js') !!}

<div class="row article">
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                <p> از زمان راه اندازی واحدهای فراهم آوری اعضای پیوندی در کشورمان، مراکز مختلفی شروع به ثبت نام و
                    صدور کارت اهدای عضو نمودند. در روزها و ماه‌های اول تعداد ثبت نام به بیش از 100 نفر در ماه نمی
                    رسید، اما با شروع تبلیغات فرهنگی و برگزاری جشن نفس، تعداد بیشتری از مردم نیک اندیش سرزمینمان
                    با این امر مقدس آشنا شدند و تعداد افراد متقاضی کارت اهدای عضو به بیش از 500 نفر در روز رسید...
                    تقاضای دریافت کارت اهدای عضو روز به روز بیشتر شد، به اندازه ای که مدت زمان دریافت کارت اهدای
                    عضو برای هر فرد به بیش از 5ماه رسید. باتوجه به اینکه کارت اهدای عضو صرفاً نشان دهنده رضایت قلبی
                    هر شخص برای اهدای عضو در زمان مرگ میباشد و جنبه‌‌ی قانونی ندارد؛ لذا بر آن شدیم تا سامانه ای راه
                    اندازی کنیم که مدت زمان دریافت کارت را به طرز چشمگیری کاهش دهد تا انتظار رسیدن این کارت، مردم
                    ایثارگر میهن عزیزمان را آزرده خاطر نسازد. </p>
                <p>
                    @include('forms.button', [
                        'shape' => 'success stepOneBtn',
                        'link' => 'register_card_step_one("start")',
                        'label' => trans('site.global.card_register_page')
                    ])
                </p>
            </div>
            <div class="col-xs-12 col-md-8 col-md-offset-2 stepOneForm">
                {!! Form::open([
                            'url'	=> 'register/first_step' ,
                            'method'=> 'post',
                            'class' => 'clearfix ehda-card-form js',
                            'name' => 'register_form_step_one',
                            'id' => 'register_form_step_one',
                        ]) !!}

                <div class="form-group">
                    <div>اطلاعات فردی</div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="name_first">{{ trans('validation.attributes.name_first') }}: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-persian" id="name_first" name="name_first" data-toggle="tooltip" data-placement="top" placeholder="{{ trans('validation.attributes_placeholder.name_first') }}" title="{{ trans('validation.attributes_example.name_first') }}" minlength="2" error-value="{{ trans('validation.javascript_validation.name_first') }}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="name_last">{{ trans('validation.attributes.name_last') }}: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-persian" id="name_last" name="name_last" data-toggle="tooltip" data-placement="top" placeholder="{{ trans('validation.attributes_placeholder.name_last') }}" title="{{ trans('validation.attributes_example.name_last') }}" minlength="2" error-value="{{ trans('validation.javascript_validation.name_last') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="code_melli">{{ trans('validation.attributes.code_melli') }}: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-national" id="code_melli" name="code_melli" data-toggle="tooltip" data-placement="top" placeholder="{{ trans('validation.attributes_placeholder.code_melli') }}" title="{{ trans('validation.attributes_example.code_melli') }}" minlength="10" maxlength="10" error-value="{{ trans('validation.javascript_validation.code_melli') }}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="security">{{ $captcha['question'] }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-required" id="security" name="security" data-toggle="tooltip" data-placement="top" placeholder="{{ trans('validation.attributes_placeholder.security') }}" title="{{ trans('validation.attributes_example.security') }}" minlength="1" error-value="{{ trans('validation.javascript_validation.security') }}">
                            <input type="hidden" name="key" value="{{$captcha['key']}}">
                        </div>
                    </div>
                </div>
                @include('forms.feed')
                <p>
                    @include('forms.button', [
                        'shape' => 'success',
                        'label' => trans('forms.button.send'),
                        'type' => 'submit',
                    ])

                    @include('forms.button', [
                        'shape' => 'warning',
                        'link' => 'register_card_step_one("stop")',
                        'label' => trans('forms.button.cancel'),
                    ])
                </p>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>