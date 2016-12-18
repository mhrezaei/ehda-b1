<div class="col-xs-12 col-sm-4">
    @if(sizeof($ngo_news))
        <h4>{{ trans('site.global.news') }} {{ trans('site.know_menu.internal-ngo') }}</h4>
        <ul class="news list-unstyled">
            @foreach($ngo_news as $one_news)
                <li>
                    <a href="{{ $one_news->say('link') }}">@pd($one_news->say('title_limit'))</a>
                    <span class="date">@pd(jDate::forge($one_news->published_at)->format('Y F d'))</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>