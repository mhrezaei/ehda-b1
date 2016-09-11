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
	| Delete Card
	|--------------------------------------------------------------------------
	| Available only when the volunteer has active card
	--}}

	@if($model->isCard())
		<div class="panel mv20">

			<div class="mv20 text-center">
				<button class="btn btn-lg btn-warning" onclick="$('#divAlertCard').slideToggle();$('#divAlertVolunteer').slideUp()">
					{{ trans('manage.account.card_delete_button') }}
				</button>
			</div>

			<div id="divAlertCard" class="alert alert-warning noDisplay">
				@include('templates.widgets.alert' , [
					'shape' => 'danger' ,
					'texts' => [
						trans('people.cards.manage.delete_notice_1') ,
						trans('people.cards.manage.delete_notice_2') ,
					]
				])

				@include('forms.opener' , [
					'url' => 'manage/account/save/card_delete',
					'class' => 'js' ,
				])

					<div class="row w60 mv10">
						<div class="col-md-6 text-center">
							<button type="submit" class="btn btn-danger">
								{{ trans('manage.account.card_delete_button') }}
							</button>
						</div>
						<div class="col-md-6 text-center">
							<button type="button" class="btn btn-default" onclick="$('#divAlertCard').slideToggle()">
								{{ trans('forms.button.cancel') }}
							</button>
						</div>
					</div>

					@include('forms.feed' , [])

				@include('forms.closer')

			</div>

		</div>
	@endif

	{{--
	|--------------------------------------------------------------------------
	| Delete Volunteer Account
	|--------------------------------------------------------------------------
	|
	--}}

	<div class="panel mv20">

		<div class="mv20 text-center">
			<button class="btn btn-lg btn-danger" onclick="$('#divAlertVolunteer').slideToggle();$('#divAlertCard').slideUp()">
				{{ trans('manage.account.volunteer_delete_button') }}
			</button>
		</div>

		<div id="divAlertVolunteer" class="alert alert-warning noDisplay">
			@include('templates.widgets.alert' , [
				'shape' => 'danger' ,
				'texts' => [
					trans('people.volunteers.manage.delete_notice_1') ,
					$model->isCard()? trans('people.volunteers.manage.delete_notice_2') : trans('people.volunteers.manage.delete_notice_3') ,
					trans('people.volunteers.manage.delete_notice_4') ,
				]
			])

			@include('forms.opener' , [
				'url' => 'manage/account/save/volunteer_delete',
				'class' => 'js' ,
			])

				<div class="row w60 mv10">
					<div class="col-md-6 text-center">
						<button type="submit" class="btn btn-danger">
							{{ trans('manage.account.volunteer_delete_button') }}
						</button>
					</div>
					<div class="col-md-6 text-center">
						<button type="button" class="btn btn-default" onclick="$('#divAlertVolunteer').slideToggle()">
							{{ trans('forms.button.cancel') }}
						</button>
					</div>
				</div>

				@include('forms.feed' , [])

			@include('forms.closer')

		</div>

	</div>

@endsection