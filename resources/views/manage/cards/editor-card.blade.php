<img id="imgCard" src="" style="height: 450px">
@include('forms.opener' , [
	'id' => 'frmEditor',
	'url' => 'manage/cards/save/add_to_print',
//	'title' => $model->id? trans('people.cards.manage.edit').' '.$model->fullName() : trans('people.cards.manage.create') ,
	'class' => 'js' ,
])

<input type="hidden" id="txtCard" name="code_melli">


@include('forms.button' , [
	'label' => trans('people.cards.manage.send_to_print'),
	'value' => 'print' ,
	'shape' => 'primary',
	'type' => 'submit' ,
	'class' => 'btn-lg m30'
])

@if(Auth::user()->can('cards.edit'))
	@include('forms.button' , [
		'label' => trans('people.cards.manage.edit'),
		'value' => 'edit' ,
		'shape' => 'default',
		'type' => 'submit' ,
		'class' => 'btn-lg m30'
	])
@endif

@include("forms.select" , [
	'name' => "event_id",
	'value' => $model->event_id,
	'blank_value' => "",
	'blank_label' => " ",
	'options' => $events,
])



@include('forms.feed' , [])
@include('forms.closer')
<div class="mv45">&nbsp;</div>