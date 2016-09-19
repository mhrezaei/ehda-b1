<div class="container">
    <div class="row archive">
        @if(sizeof($archive))
            @foreach($archive as $post)
                <div class="media">
                    <a class="media-right" href="{{ $post->say('link') }}">
                        {{--<img class="media-right" src="{{ $post->say('featured_image') }}">--}}
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="{{ $post->say('link') }}">@pd($post->title)</a>
                        </h4>
                        @if(strlen($post->abstract))
                            <p style="text-align: justify;">
                                {{ $post->say('abstract') }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="row" style="text-align: center; font-size: 14px; color: #0A3C6E;">{{ trans('site.global.no_post') }}</div>
        @endif
            <div class="row" style="text-align: center; margin: 0 auto;">
                {!! $archive->render() !!}
            </div>
    </div>
</div>