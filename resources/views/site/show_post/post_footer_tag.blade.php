<div class="tags col-xs-12 col-sm-6">
    @if(sizeof($post->keywords()))
        {{ trans('validation.attributes.keywords') }}:
        @foreach($post->keywords() as $keyword)
            <a class="btn btn-sm btn-info" href="{{ url("/tags/" . urlencode($keyword)) }}">{{ $keyword }}</a>
        @endforeach
    @endif
</div>