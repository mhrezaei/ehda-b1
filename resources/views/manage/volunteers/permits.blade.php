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

	@if(isset($opt['domains']))
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
	@endif

	@if(Auth::user()->isDeveloper())
		@include('forms.select' , [
			'name' => 'level' ,
			'value' => $model->can('manage') ,
			'options' => [
				[ 0 , trans('people.volunteers.manage.level_user')] ,
				[ 1 , trans('people.volunteers.manage.level_admin')]
			],
			'value_field' => '0' ,
			'caption_field' => '1' ,
		])
	@endif


	{{--
	|--------------------------------------------------------------------------
	| Roles
	|--------------------------------------------------------------------------
	|
	--}}

	@include('manage.volunteers.permits-role' , [
		'module' => 'cards' ,
		'permits' => 'cards' ,
		'label' => trans('manage.modules.cards')
	])
	@include('manage.volunteers.permits-role' , [
		'module' => 'volunteers' ,
		'permits' => 'volunteers' ,
		'label' => trans('manage.modules.volunteers')
	])

	@foreach($opt['branches'] as $branch)
		@include('manage.volunteers.permits-role' , [
			'module' => $branch->slug ,
			'permits' => 'posts' ,
			'label' => $branch->plural_title ,
		])
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