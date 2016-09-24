@include('templates.modal.start' , [
	'partial' => true ,
	'form_url' => url('manage/volunteers/save/permits'),
	'modal_title' => trans('manage.permits.permits'),
])
<div class='modal-body'>

	@include('forms.hiddens' , ['fields' => [
		['id' , $model->id ],
	]])

	@include('forms.input' , [
		'name' => '',
		'label' => trans('validation.attributes.name_first'),
		'value' => $model->fullName() ,
		'extra' => 'disabled' ,
	])

	{{--
	|--------------------------------------------------------------------------
	| Domain
	|--------------------------------------------------------------------------
	|
	--}}

	@include('forms.select' , [
		'name' => 'domain' ,
		'value' =>  $model->domain  ,
		'blank_value' => ' ' ,
		'blank_label' => trans('forms.general.none') ,
		'options' => $opt['domains'] ,
		'search' => true ,
		'size' => 7 ,
		'value_field' => 'slug' ,
		'search_placeholder' => trans('forms.button.search') ,
	])


	{{--
	|--------------------------------------------------------------------------
	| Roles
	|--------------------------------------------------------------------------
	|
	--}}

	@include('forms.sep')

{{--		@include('manage.volunteers.permits-role' , [--}}
			{{--'module' => 'cards' ,--}}
			{{--'label' => trans('label')--}}
		{{--])--}}
{{ $sd }}
	@include('templates.say' , ['array'=>$opt['branches']]);




	@foreach($opt['branches'] as $branch)
	@endforeach

	@foreach(config('permit.available_modules') as $module => $permits )

		<?php
			if(str_contains($module,'posts-')) {
				$slug = str_replace('posts-','',$module) ;
				$caption = \App\Models\Branch::getTitle($slug);
			}
			else {
				$caption = trans('manage.modules.'.$module) ;
			}
		?>

		@include('forms.group-start' , [
			'label' => trans($caption),
		])

			<div class="row w100 m5">
				@foreach($permits as $permit)
					<div class="col-md-3">
						<div class="checkbox">
							<label>
								<input type="hidden" name="permit{{$module}}_{{$permit}}" value="0">
								{!! Form::checkbox("permit".$module."_".$permit , '1' , $model->can("$module.$permit")? '1' : '0' , ['class' => '-permits']) !!}
								{{ trans('manage.permits.'.$permit) }}
							</label>
						</div>
					</div>
				@endforeach
			</div>

		@include('forms.group-end')

	@endforeach

	@include('forms.group-start')
		<a href="javascript:void(0)" onclick="$('.-permits').prop('checked', true)" class="p20">{{trans('forms.general.all')}}</a>
		<a href="javascript:void(0)" onclick="$('.-permits').prop('checked', false)" class="">{{trans('forms.general.none')}}</a>
	@include('forms.group-end')

	{{--
	|--------------------------------------------------------------------------
	| Domains
	|--------------------------------------------------------------------------
	| 
	--}}

	{{--@include('forms.sep')--}}

	{{--@include('forms.group-start' , [--}}
		{{--'label' => trans('manage.devSettings.domains.trans'),--}}
		{{--'required'=> false ,--}}
	{{--])--}}

		{{--<div class="row w100 m5">--}}
			{{--@foreach($opt['domains'] as $domain)--}}
				{{--<div class="col-md-3">--}}
					{{--<div class="checkbox">--}}
						{{--<label>--}}
							{{--<input type="hidden" name="domain{{$domain->id}}" value="0">--}}
							{{--{!! Form::checkbox("domain".$domain->id , '1' , $model->can('any',$domain->slug)? '1' : '0' , ['class' => '-domains']) !!}--}}
							{{--{{ $domain->title }}--}}
						{{--</label>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--@endforeach--}}
		{{--</div>--}}

	{{--@include('forms.group-end')--}}


	{{--@include('forms.group-start')--}}
		{{--<a href="javascript:void(0)" onclick="$('.-domains').prop('checked', true)" class="p20">{{trans('forms.general.all')}}</a>--}}
		{{--<a href="javascript:void(0)" onclick="$('.-domains').prop('checked', false)" class="">{{trans('forms.general.none')}}</a>--}}
	{{--@include('forms.group-end')--}}


	{{--
	|--------------------------------------------------------------------------
	| Buttons
	|--------------------------------------------------------------------------
	|
	--}}


	@include('forms.group-start')
		@include('forms.button' , [
			'label' => trans('forms.button.save'),
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
@include('templates.modal.end')