<div class="panel panel-default w100">
	<div class="panel-heading">
		{{ trans('posts.manage.creator') }}
	</div>

	<div class="m10 text-center">
		@if($model->id)
			{{ $model->say('created_by') }}
		@else
			{{ Auth::user()->fullName() }}
		@endif
	</div>

</div>