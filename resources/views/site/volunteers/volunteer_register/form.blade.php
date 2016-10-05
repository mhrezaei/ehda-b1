{!! Html::script ('assets/site/js/persian-date-0.1.8.min.js') !!}
{!! Html::script ('assets/site/js/persian-datepicker-0.4.5.min.js') !!}
{!! Html::script ('assets/libs/jquery.form.min.js') !!}
{!! Html::script ('assets/js/forms.js') !!}

{!! Html::style('assets/libs/bootstrap-select/bootstrap-select.min.css') !!}
{!! HTML::script ('assets/libs/bootstrap-select/bootstrap-select.min.js') !!}
{!! HTML::script ('assets/libs/bootstrap-select/defaults-fa_IR.min.js') !!}


<div class="row">
    <div class="col-xs-12">
        <div class="container">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="row">
                    {!! Form::open([
                        'url'	=> '/volunteers/final_step/submit' ,
                        'method'=> 'post',
                        'class' => 'clearfix ehda-card-form js',
                        'name' => 'volunteer_final_step',
                        'id' => 'volunteer_final_step',
                    ]) !!}

                    <div class="form-group">
                        <div>{{ trans('site.global.personal_data') }}</div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'name_first',
                            'min' => 2,
                            'class' => 'form-persian form-required',
                            'required' => 1,
                            'value' => $user->name_first
                            ])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'name_last',
                            'min' => 2,
                            'class' => 'form-persian form-required',
                            'required' => 1,
                            'value' => $user->name_last
                            ])
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.select_gender', [
                                'field' => 'gender',
                                'class' => 'form-select form-required',
                                'required' => 1,
                                'value' => $user->name_last
                                ])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'name_father',
                            'min' => 2,
                            'class' => 'form-persian form-required',
                            'required' => 1,
                            'value' => $user->name_father
                            ])
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'code_id',
                            'min' => 1,
                            'max' => 10,
                            'class' => 'form-number form-required',
                            'required' => 1,
                            'value' => $user->code_id
                            ])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'code_melli',
                            'min' => 10,
                            'max' => 10,
                            'class' => 'form-national form-required',
                            'required' => 1,
                            'value' => $user->code_melli,
                            'attr' => 'readonly'
                            ])
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'birth_date',
                            'class' => 'form-datepicker form-required',
                            'required' => 1,
                            'attr' => 'autocomplete=off',
                            'value' => $user->birth_date ? jDate::forge($user->birth_date)->format('Y/m/d') : ''
                            ])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.select_city' , [
                            'field' => 'birth_city' ,
                            'blank_value' => '0' ,
                            'options' => $states ,
                            'search' => true ,
                            'required' => 1,
                            'class' => 'form-selectpicker form-required',
                            'value' => $user->birth_city
                            ])
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.select_marital', [
                                'field' => 'marital',
                                'class' => 'form-select form-required',
                                'required' => 1,
                                'value' => $user->marital
                                ])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'job',
                            'min' => 2,
                            'class' => 'form-persian  form-required',
                            'required' => 1,
                            'value' => $user->job
                             ])
                        </div>
                    </div>

                    <div class="form-group">
                        <div>{{ trans('site.global.contact_detail') }}</div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'tel_mobile',
                            'min' => 11,
                            'max' => 11,
                            'class' => 'form-mobile form-required',
                            'required' => 1,
                            'value' => $user->tel_mobile
                            ])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'home_tel',
                            'min' => 11,
                            'max' => 11,
                            'class' => 'form-phone form-required',
                            'required' => 1,
                            'value' => $user->home_tel
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
                            'class' => 'form-selectpicker form-required',
                            'value' => $user->home_city
                            ])
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            @include('forms_site.input', [
                            'field' => 'email',
                            'class' => 'form-email form-required',
                            'required' => 1,
                            'value' => $user->email
                            ])
                        </div>
                    </div>

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
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>