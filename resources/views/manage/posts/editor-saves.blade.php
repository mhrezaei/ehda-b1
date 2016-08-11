<div class="panel panel-default w100">
	<div class="panel-heading">
		{{ trans('posts.manage.save_changes') }}
	</div>
	<div class="text-center m10">
		<button type="button" class="btn btn-link btn-sm">{{ trans('posts.manage.preview') }}</button>
	</div>
	@if($model->published_at)
		<div class="text-center m10">
			<button type="button" class="btn btn-link btn-s,">{{ trans('posts.manage.view_original') }}</button>
		</div>
	@endif
	<div class="text-center m10">
		<button type="button" class="btn btn-info btn-sm">{{ trans('posts.manage.save_as_draft') }}</button>
	</div>
	<div class="text-center m10">
		<button type="button" class="btn btn-primary btn-sm">{{ trans('posts.manage.save_to_review') }}</button>
	</div>
</div>