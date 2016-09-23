<div class="row article">
    <div class="col-xs-12">
        <div class="container">
                <div class="row">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @if(sizeof($faq))
                            @foreach($faq as $post)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading{{ $post->id }}">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $post->id }}" aria-expanded="false" aria-controls="collapse{{ $post->id }}">
                                                {{--@pd($post->title)--}}
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{ $post->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $post->id }}">
                                        <div class="panel-body">
                                            {{--@pd($post->text)--}}
                                            {!! $post->text !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>