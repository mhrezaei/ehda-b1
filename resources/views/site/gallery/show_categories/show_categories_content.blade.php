<div class="row gallery-archive">
    <div class="container">
        <div class="row" style="margin:20px 0">

            @if(sizeof($branch_data->categories))
                @foreach($branch_data->categories as $category)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ url('/gallery/posts/' . $category->slug) }}" class="thumbnail">
                            <img class="media-object" src="{{ url('') . $category->featured_image }}" alt="{{ $category->title }}">
                            <span class="media-title">{{ $category->title }}</span>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#gallery a").featherlightGallery({
            openSpeed: 300
        });
        $.featherlightGallery.prototype.afterContent = function() {
            var caption = this.$currentTarget.find('img').attr('alt');
            this.$instance.find('.featherlight-caption').remove();
            $('<h4 class="featherlight-caption text-right">').text(caption).appendTo(this.$instance.find('.featherlight-content'));
        };
    });
</script>