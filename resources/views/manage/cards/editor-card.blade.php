<img id="imgCard" src="" style="height: 450px">
@include('forms.opener' , [
	'id' => 'frmEditor',
	'url' => 'manage/cards/save/add_to_print',
//	'title' => $model->id? trans('people.cards.manage.edit').' '.$model->fullName() : trans('people.cards.manage.create') ,
	'class' => 'js' ,
])

<input type="hidden" id="txtCard" name="code_melli">
<button type="submit" class="btn btn-success btn-lg m30">{{ trans('people.cards.manage.send_to_print') }}</button>

@include('forms.feed' , [])
@include('forms.closer')