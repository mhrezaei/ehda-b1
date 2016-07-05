<button
		type="{{ $type or 'button' }}"
		class="btn btn-{{$shape or 'default'}}"
		@if(isset($link))
			onclick="window.location ='{{ url($link) }}'"
		@endif
>
	{{$label or ''}}
</button>
