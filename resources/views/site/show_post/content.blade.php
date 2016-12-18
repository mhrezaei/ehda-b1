<div class="container">
    <div class="row">
        <div class="article">
            <div class="col-xs-12" style="text-align: justify;">
                @if($post->branch()->slug != 'statics')
                    <h3 class="post-title">@pd($post->title)</h3>
                @endif

                {!! $post->text !!}
                <small>{{ trans('validation.attributes.publish_date') }}: {{ $post->say('published_at') }}</small>
            </div>

            @include('site.show_post.post_footer')

        </div>
    </div>
</div>