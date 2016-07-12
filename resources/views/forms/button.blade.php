<button
		type="{{ $type or 'button' }}"
		class="btn btn-{{$shape or 'default'}}"
		@if(isset($link) and (str_contains($link , '(') or str_contains($link , ')')))
			onclick="{{$link}}"
		@elseif(isset($link))
			onclick="window.location ='{{ url($link) }}'"
		@endif
>
	{{$label or ''}}
</button>
