<div class="panel panel-default w100">
	<div class="panel-heading">
		{{ trans('posts.manage.save_changes') }}
	</div>

	{{-- View the Original --}}
	@if($model->isPublished())
		<div class="text-center m10">
			<button type="button" class="btn btn-default btn-sm">
					{{ trans('posts.manage.view_original') }}
			</button>
		</div>
	@endif

	{{-- Preview Button --}}
	<div class="text-center m10">
		<button type="button" class="btn btn-link btn-sm" onclick="postSave('preview')">{{ trans('posts.manage.preview') }}</button>
	</div>

	{{-- Save as draft --}}
	<div class="text-center m10">
		<button type="button" class="btn btn-info btn-sm" onclick="postSave('draft')">{{ trans('posts.manage.save_as_draft') }}</button>
	</div>

	{{-- Save to review --}}
	<div class="text-center m10">
		<button type="button" class="btn btn-primary btn-sm" onclick="postSave('review')">{{ trans('posts.manage.save_to_review') }}</button>
	</div>

	{{-- Delete --}}
	@if($model->id and $model->canDelete())
		<div class="text-center m10">
			<button type="button" class="btn btn-link btn-sm" onclick="postChange('delete')">
			<span class="text-danger">
				{{ trans('forms.button.soft_delete') }}
			</span>
			</button>
		</div>
	@endif
</div>