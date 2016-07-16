{{--
|--------------------------------------------------------------------------
| Inserts a dropdown action button
|--------------------------------------------------------------------------
| Parameters: $id AND $actions = ['fa_icon' , 'caption' , 'link or js_command' , optional permit command , optional boolian condition]
--}}

<td class="dropdown">
	<button id="action{{$id}}" class="btn btn-default btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		{{trans('forms.button.action')}}
	</button>
	<ul class="dropdown-menu" aria-labelledby="action{{$id}}">
		@foreach($actions as $action)
			<?php
				$icon = $action[0] ;
				$caption = $action[1] ;
				if(str_contains($action[2],'(')) {
					$js_command = $action[2] ;
					$target = 'javascript:void(0)' ;
				}
				else {
					$js_command = null ;
					$target = $action[2] ;
				}
				if(isset($action[3]))
					$permit = \Illuminate\Support\Facades\Auth::user()->can($action[3]) ;
				else
					$permit = true ;

				if(isset($action[4]))
					$permit = $action[4] and $permit ;

			?>
			@if($permit)
				<li>
					<a href="{{$target}}" onclick="{{$js_command}}">
						<i class="fa fa-{{$icon or 'circle'}} fa-fw"></i>
						{{ $caption }}
					</a>
				</li>
			@endif
		@endforeach
	</ul>
</td>
