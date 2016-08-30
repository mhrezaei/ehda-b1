{!! Html::script ('assets/site/js/persian-date-0.1.8.min.js') !!}
{!! Html::script ('assets/site/js/persian-datepicker-0.4.5.min.js') !!}
{!! Html::script ('assets/site/js/states.js') !!}
{!! Html::script ('assets/libs/jquery.form.min.js') !!}
{!! Html::script ('assets/js/forms.js') !!}

{!! Html::style('assets/libs/bootstrap-select/bootstrap-select.min.css') !!}
{!! HTML::script ('assets/libs/bootstrap-select/bootstrap-select.min.js') !!}
{!! HTML::script ('assets/libs/bootstrap-select/defaults-fa_IR.min.js') !!}


<div class="row">
    <div class="col-xs-12">
        <div class="container">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="row text-center">
                    <img src="{{ url('') }}/assets/site/images/card.png" alt="کارت اهدای عضو" class="ehda-card-image">
                </div>
                <div class="row">
                        {!! Form::open([
                            'url'	=> '/register/second_step' ,
                            'method'=> 'post',
                            'class' => 'clearfix ehda-card-form js',
                            'name' => 'registerForm',
                            'id' => 'registerForm',
                        ]) !!}

                        <div class="form-group">
                            <div>اطلاعات فردی</div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'name_first',
                                'min' => 2,
                                'class' => 'form-persian',
                                'required' => 1,
                                'value' => $input['name_first']
                                ])
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'name_last',
                                'min' => 2,
                                'class' => 'form-persian',
                                'required' => 1,
                                'value' => $input['name_last']
                                ])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.select_gender', [
                                    'field' => 'gender',
                                    'class' => 'form-select',
                                    'required' => 1,
                                    ])
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'name_father',
                                'min' => 2,
                                'class' => 'form-persian',
                                'required' => 1,
                                ])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'code_id',
                                'min' => 1,
                                'max' => 10,
                                'class' => 'form-number',
                                'required' => 1,
                                ])
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'code_melli',
                                'min' => 10,
                                'max' => 10,
                                'class' => 'form-national',
                                'required' => 1,
                                'value' => $input['code_melli'],
                                'attr' => 'readonly'
                                ])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'birth_date',
                                'class' => 'form-datepicker',
                                'required' => 1,
                                'attr' => 'autocomplete=off',
                                ])
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.select_city' , [
                                'field' => 'birth_city' ,
                                'blank_value' => '0' ,
                                'options' => $states ,
                                'search' => true ,
                                'required' => 1,
                                ])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.select_edu_level', [
                                    'field' => 'edu_level',
                                    'class' => 'form-select',
                                    'required' => 1,
                                    ])
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'job',
                                'min' => 2,
                                'class' => 'form-persian',
                                'required' => 1,
                                 ])
                            </div>
                        </div>

                        <div class="form-group">
                            <div>اطلاعات تماس</div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'tel_mobile',
                                'min' => 11,
                                'max' => 11,
                                'class' => 'form-mobile',
                                'required' => 1,
                                ])
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'home_tel',
                                'min' => 11,
                                'max' => 11,
                                'class' => 'form-phone',
                                'required' => 1,
                                ])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.select_city' , [
                                'field' => 'home_city' ,
                                'blank_value' => '0' ,
                                'options' => $states ,
                                'search' => true ,
                                'required' => 1,
                                ])
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'email',
                                'class' => 'form-email',
                                'required' => 1,
                                ])
                            </div>
                        </div>

                        <div class="form-group">
                            <div>اطلاعات ورود به سامانه</div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'password',
                                'class' => 'form-password',
                                'required' => 1,
                                'type' => 'password',
                                'min' => 8,
                                'max' => 64,
                                ])
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                @include('forms_site.input', [
                                'field' => 'password2',
                                'class' => '',
                                'required' => 1,
                                'type' => 'password',
                                'min' => 8,
                                'max' => 64,
                                ])
                            </div>
                        </div>

                    @include('forms_site.organs_checkbox')
                    @include('forms.feed')
                        <div class="form-group text-center">
                            @include('forms.button', [
                                'shape' => 'success step_one_btn',
                                'label' => trans('forms.button.send'),
                                'type' => 'submit',
                            ])
                            @include('forms.button', [
                                'shape' => 'warning step_one_btn',
                                'label' => trans('forms.button.cancel'),
                                'type' => 'button',
                                'link' => url(''),
                            ])
                            <button type="submit" class="btn btn-link submit" data-toggle="tooltip" title="ارسال اطلاعات و انجام ثبت نام" data-placement="bottom" style="display: none;">
                                <img src="{{ url('') }}/assets/site/images/form-submit.png" width="190" height="190">
                            </button>
                        </div>
                    {!! Form::close() !!}

                    @include('site.card_register.db_check_form')

                </div>
            </div>
        </div>
    </div>
</div>