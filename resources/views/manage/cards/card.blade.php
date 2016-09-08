@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/permits'),
	'modal_title' => trans('people.commands.view_card'),
])

<div class='modal-body text-center'>
	<a href="{{url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))}}" target="_blank">
		<img src="{{url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))}}" style="height: 500px">
	</a>
</div>

@include('templates.modal.end')
