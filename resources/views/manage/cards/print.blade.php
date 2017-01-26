@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/cards/save/print'),
	'modal_title' => trans('forms.button.card_print'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

{{--	@include('forms.input' , [--}}
		{{--'name' => '',--}}
		{{--'label' => trans('validation.attributes.name_first'),--}}
		{{--'value' => $model->fullName() ,--}}
		{{--'extra' => 'disabled' ,--}}
	{{--])--}}

	@include("forms.select" , [
		'name' => "event_id",
		'value' => $model->event_id,
		'blank_value' => "",
		'blank_label' => " ",
		'options' => $events,
	])



	@include('forms.group-start')

		@include('forms.button' , [
			'label' => trans('people.cards.manage.send_to_print'),
			'shape' => 'success',
			'type' => 'submit' ,
		])
		@include('forms.button' , [
			'label' => trans('forms.button.cancel'),
			'shape' => 'link',
			'link' => '$(".modal").modal("hide")',
		])

	@include('forms.group-end')

	@include('forms.feed')

</div>

<div class="text-center mv20">
	<a href="{{url('/card/show_card/full/'.$model->say('encrypted_code_melli'))}}" target="_blank">
		<img src="{{url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))}}" style="height: 350px">
	</a>
</div>


@include('templates.modal.end')