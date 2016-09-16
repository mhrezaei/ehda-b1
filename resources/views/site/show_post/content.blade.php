<div class="container">
    <div class="row">
        <div class="article">
            <div class="col-xs-12">
                @if($post->branch()->slug != 'statics')
                    <h3 class="post-title">{{ $post->title }}</h3>
                @endif

                {!! $post->text !!}

            </div>

            @include('site.show_post.post_footer')

        </div>
    </div>
</div>