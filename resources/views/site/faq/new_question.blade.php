<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingqs">
        <h4 class="panel-title">
            <a class="collapsed" style="color: #1F398B;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseqs" aria-expanded="false" aria-controls="collapseqs">
                <span class="glyphicon glyphicon-pencil"></span> {{ trans('site.global.new_faq_qs') }}
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
            {!! Form::open([
                'url'	=> '/faq/new' ,
                'method'=> 'post',
                'class' => 'clearfix ehda-card-form js',
                'name' => 'new_faq_qs',
                'id' => 'new_faq_qs',
            ]) !!}

            <div class="col-xs-12 col-sm-6">
                @include('forms_site.input', [
                'field' => 'full_name',
                'min' => 2,
                'class' => 'form-persian form-required',
                'required' => 1,
                'value' => $full_name,
                ])
            </div>

            <div class="col-xs-12 col-sm-6">
                @include('forms_site.input', [
                'field' => 'email',
                'class' => 'form-email form-required',
                'required' => 1,
                'value' => $email,
                ])
            </div>

            <div class="col-xs-12 col-sm-6">
                @include('forms_site.input', [
                'field' => 'tel_mobile',
                'min' => 11,
                'max' => 11,
                'class' => 'form-mobile',
                'value' => $tel_mobile,
                ])
            </div>

            <div class="col-xs-12 col-sm-6">
                @include('forms_site.input', [
                'field' => 'title',
                'class' => 'form-persian',
                ])
            </div>

            <div class="col-xs-12 col-sm-12">
                @include('forms_site.textarea', [
                'field' => 'text',
                'class' => 'form-persian form-required',
                'min' => 10,
                'required' => 1,
                ])
            </div>
            <div style="clear: both;"></div>
            <div class="form-group" style="width: 50%; margin: 0 auto;">
                @include('forms.feed')
            </div>
            <div style="clear: both;"></div>
            <div class="form-group text-center">
                @include('forms.button', [
                    'shape' => 'success step_one_btn',
                    'label' => trans('forms.button.send'),
                    'type' => 'submit',
                ])
            </div>

            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
{!! Html::script ('assets/libs/jquery.form.min.js') !!}
{!! Html::script ('assets/js/forms.js') !!}