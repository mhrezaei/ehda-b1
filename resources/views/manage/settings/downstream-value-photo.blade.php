@include('forms.sep')

@include('forms.group-start' , [
    'label' => isset($domain)? $domain->title : trans('validation.attributes.global_value'),
])

	<div class="row">
		<div class="col-md-3">
			<button id="{{ isset($domain)? "btn-".$domain->slug : "btn-global" }}" data-input="{{ $input_id = isset($domain)? "txt-".$domain->slug : "txt-global" }}" data-callback="downstreamPhotoSelected('#{{ $input_id }}')" class="btn btn-default btn-sm">
				{{ trans('forms.button.browse_image') }}
			</button>
		</div>
		<div class="col-md-8">
			<input id="{{ $input_id }}" type="text" name="{{ isset($domain)? $domain->slug : 'global_value' }}" value="{{ $value = isset($domain)? $model->value($domain->slug) : $model->global_value }}" class="form-control ltr">
		</div>
		<div class="col-md-1">
			<a href="javascript:void(0)" onclick="downstreamPhotoPreview('#{{ $input_id }}')">
				<span class="fa fa-link text-grey"></span>
			</a>
		</div>
	</div>


	<script>
		$('#{{ isset($domain)? "btn-".$domain->slug : "btn-global" }}').filemanager('image');
	</script>

@include('forms.group-end')
