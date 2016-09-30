{!! Html::script ('assets/libs/jquery.form.min.js') !!}
{!! Html::script ('assets/js/forms.js') !!}

<div class="row article">
    <div class="col-xs-12">
        <div class="container">
            <div class="row">
                    {!! Form::open([
                            'url'	=> 'volunteer/second_step' ,
                            'method'=> 'post',
                            'class' => 'clearfix js',
                            'name' => 'volunteer_form_step_second',
                            'id' => 'volunteer_form_step_second',
                        ]) !!}

                    <div class="form-group" style="margin-bottom: 40px; color: #0f0f0f;">
                        <div>{{ trans('site.global.volunteer_exam_detail') }}</div>
                    </div>
                    <?php $row = 1; ?>
                    @foreach($tests as $test)
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    @pd($row++)- {!! $test['title'] !!}
                                    <div style="width: 90%; color: #002166; margin: 0 auto;">
                                        <?php $label = array('A', 'B', 'C', 'D'); $count = 0; ?>
                                        @foreach($test['answer'] as $answer)
                                            @include('site.volunteers.volunteers_exam.exam_radio_form', [
                                            'id' => $test['id'],
                                            'value' => encrypt($answer->key),
                                            'label' => trans('forms.alphabet.' . $label[$count]),
                                            'title' => $answer->value
                                            ])
                                            <?php $count++; ?>
                                        @endforeach
                                    </div>
                                    <hr style="background-color: #0A3C6E;">
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @include('forms.feed')
                    @include('forms.button', [
                        'shape' => 'success',
                        'label' => trans('forms.button.send_answer_sheet'),
                        'type' => 'submit',
                    ])

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>