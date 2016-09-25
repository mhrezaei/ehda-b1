@if($model->branch()->hasFeature('domain'))
	@if(Auth::user()->isGlobal())
		<div class="panel panel-default w100">
			<div class="panel-heading">
				{{ trans('posts.manage.visibility') }}
			</div>

			<div class="text-center m10">
				@include('forms.select_self' , [
					'name' => 'domains' ,
					'id' => 'cmbDomain' ,
					'value_field' => 'slug' ,
					'search' => true ,
					'blank_value' => 'global',
					'blank_label' => trans('posts.manage.global'),
					'on_change' => 'postEditorFeatures()' ,
					'value' => str_replace('*' , null , $model->domains) ,
					'options' => $domains->get() ,
				])
			</div>
			
			<div class="m10">
				@include('forms.check' , [
					'name' => '_in_global',
					'label' => trans('posts.manage.also_in_global'),
					'value' => str_contains($model->domains , '*')? true : false ,
					'id' => 'chkGlobal',
				])
			</div>
		</div>
	@endif
@endif