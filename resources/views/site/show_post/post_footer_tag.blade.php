<div class="tags col-xs-12 col-sm-6">
    @if($post->meta('source'))
        <a class="btn btn-sm btn-primary" target="_blank" href="{{ $post->meta('source') }}">{{ trans('validation.attributes.source') }}</a>
    @endif
    @if(sizeof($post->getKeywords()))
        {{ trans('validation.attributes.keywords') }}:
        @foreach($post->getKeywords() as $keyword)
            <a class="btn btn-sm btn-info" href="{{ url("/tags/" . urlencode($keyword)) }}">{{ $keyword }}</a>
        @endforeach
    @endif
</div>