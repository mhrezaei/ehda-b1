<div class="col-xs-12 col-sm-6">
    @if(sizeof($news))
        <h3>{{ trans('site.global.news') }}</h3>
        <ul class="news list-unstyled">
            @foreach($news as $one_news)
                <li>
                    {{--<a href="{{ url('showPost/' . $one_news->id . '/' . urlencode($one_news->title)) }}">@pd($one_news->title)</a>--}}
                    <a href="{{ url('showPost/' . $one_news->id . '/' . urlencode($one_news->title)) }}">{{ $one_news->title }}</a>
                    <span class="date">@pd(jDate::forge($one_news->published_at)->format('Y F d'))</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>