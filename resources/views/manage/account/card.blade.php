@extends('manage.frame.use.0')

@section('section')
	@include('manage.account.tabs')

	{{--
	|--------------------------------------------------------------------------
	| Toolbar
	|--------------------------------------------------------------------------
	|
	--}}
	<div class="panel panel-toolbar row w100">
		<div class="col-md-4"><p class="title">{{$page[1][1] or ''}}</p></div>
	</div>


	{{--
	|--------------------------------------------------------------------------
	| Showing the card
	|--------------------------------------------------------------------------
	| Appears only when the user has card already.
	--}}

	@if($model->isCard())
		<div class="w100 mv20 text-center">
			<a class="mv20" href="{{$url = url('/card/show_card/mini/'.$model->say('encrypted_code_melli'))}}" target="_blank">
				<img src="{{$url}}" style="height: 450px">
			</a>
		</div>
	@endif


	{{--
	|--------------------------------------------------------------------------
	| Registeration / Edit Button
	|--------------------------------------------------------------------------
	|
	--}}
	<div id="divBigButton" class="w100 mv20 text-center">
		<button class="btn btn-primary btn-lg mv20" onclick="$('#divBigButton,#divCardForm').slideToggle()">
			{{ $model->isCard()? trans('people.cards.manage.edit') : trans('site.global.card_register_page') }}
		</button>
	</div>


	{{--
	|--------------------------------------------------------------------------
	| Registeration Form
	|--------------------------------------------------------------------------
	| Is shown uppon pressing of the big blue registeration or edit button
	--}}
	<div id="divCardForm" class="w100 mv20 noDisplay">
		@include('forms.opener' , [
			'url' => 'manage/account/save/card',
			'class' => 'js mv20' ,
			'no_validation' => 1
		])

			@include('forms.input' , [
				'name' => 'name_first',
				'value' => $model->fullName(),
				'extra' => 'disabled',
			])
			@include('forms.input' , [
				'name' => 'code_melli',
				'value' => $model->say('code_melli'),
				'extra' => 'disabled',
			])

			@include('forms.group-start' , [
				'required' => true ,
				'label' => trans('validation.attributes.organs')
			])

				@include('manage.cards.editor-organs' , [
					'organs' => $model::$donatable_organs ,
				])

			@include('forms.group-end')

			@include('forms.group-start' , [
				'label' => trans('validation.attributes.newsletter')
			])

				@include('forms.check' , [
					'name' => 'newsletter',
					'value' => $model->newsletter,
					'label' => trans('people.cards.manage.newsletter_membership2')
				])

			@include('forms.group-end')


			@include('forms.group-start')

				@include('forms.button' , [
					'label' => $model->isCard()? trans('people.cards.manage.edit') : trans('site.global.card_register_page'),
					'shape' => 'success',
					'type' => 'submit' ,
					'value' => 'save' ,
				])

			@include('forms.group-end')

			@include('forms.feed' , [])
		@include('forms.closer')
	</div>




@endsection