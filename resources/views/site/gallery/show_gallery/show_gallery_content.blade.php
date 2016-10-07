{!! Html::script ('assets/site/js/featherlight.min.js') !!}
{!! Html::script ('assets/site/js/featherlight.gallery.min.js') !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<div class="row gallery-archive">
    <div class="container">
        <div class="row">
            <div class="flex_wrapper" id="gallery">
                @if(sizeof(json_decode($gallery->meta('post_photos'), true)))
                    <?php
                    $array = [];
                    $count = 1;
                    for ($i = 0; $i < count(json_decode($gallery->meta('post_photos'), true)); $i++) {
                        $array[] = (8 * $i) + 5;
                    }
                    ?>
                    @foreach(json_decode($gallery->meta('post_photos'), true) as $key => $pic)
                        <?php
                        $image = explode('/', $pic['src']);
                        $image_thumbs = str_replace($image[count($image) - 1], 'thumbs/' . $image[count($image) - 1], $pic['src']);
                        ?>
                        @if(in_array($count, $array))
                            <div class="flex-item" id="{{ $count }}"></div>
                            <?php $count++; ?>
                        @endif
                        <div class="flex-item" id="{{ $count }}">
                            <a href="{{ url('') . $pic['src'] }}" class="inner">
                                <img src="{{ url('') . $image_thumbs }}" alt="{{ $pic['label'] }}"
                                     style="width: 300px; height: 300px;">
                            </a>
                        </div>
                        <?php $count++; ?>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#gallery a").featherlightGallery({
            openSpeed: 300
        });
        $.featherlightGallery.prototype.afterContent = function () {
            var caption = this.$currentTarget.find('img').attr('alt');
            this.$instance.find('.featherlight-caption').remove();
            $('<h4 class="featherlight-caption text-right">').text(caption).appendTo(this.$instance.find('.featherlight-content'));
        };
    });
</script>