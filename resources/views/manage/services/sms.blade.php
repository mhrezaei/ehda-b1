@extends('manage.frame.use.0')

@section('page_heading' , trans('people.commands.send_sms'))

@section('section')

	<div class="panel panel-default w80 margin-auto mv20">
		<div class="panel panel-heading">
			{{ trans('people.commands.send_sms') }}
		</div>
		<div class="panel panel-body">

			@include("forms.opener" , [
				'url' => "manage/services/sms",
				'no-validation' => true,
				'id' => "frmSMS",
				'class' => "js",
			])

			@include("forms.textarea" , [
				'id' => "txtNumbers",
				'name' => "numbers",
				'hint' => trans('people.form.bulk_sms_hint'),
				'class' => "ltr form-required",
			])

			@include("forms.textarea" , [
				'id' => "txtSmsText",
				'name' => "text",
				'class' => "form-required",
				'rows' => "10",
				'on_change' => "smsTextCounter()",
			])

			@include("forms.group-start")

				@include("forms.button" , [
					'type' => "submit",
					'label' => trans('people.commands.send_sms'),
					'shape' => "primary",
				])

				@include("forms.button" , [
					'type' => "button",
					'label' => trans('forms.button.form_reset'),
					'link' => "forms_reset('#frmSMS', 'numbers')",
				])

			@include("forms.group-end")

			@include('forms.feed')


			@include("forms.closer")


		</div>

	</div>

@endsection
