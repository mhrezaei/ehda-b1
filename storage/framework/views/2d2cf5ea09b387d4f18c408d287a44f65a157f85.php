<?php echo Html::script ('assets/site/js/featherlight.min.js'); ?>

<?php echo Html::script ('assets/site/js/featherlight.gallery.min.js'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<div class="row gallery-archive">
    <div class="container">
        <div class="row">
            <div class="flex_wrapper" id="gallery">
                <?php if(sizeof(json_decode($gallery->meta('post_photos'), true))): ?>
                    <?php foreach(json_decode($gallery->meta('post_photos'), true) as $pic): ?>
                        <?php
                            $image = explode('/', $pic['src']);
                            $image_thumbs = str_replace($image[count($image) -1], 'thumbs/' . $image[count($image) -1], $pic['src']);
                        ?>
                        <div class="flex-item">
                            <a href="<?php echo e(url('') . $pic['src']); ?>" class="inner">
                                <img src="<?php echo e(url('') . $image_thumbs); ?>" alt="<?php echo e($pic['label']); ?>" style="width: 300px; height: 300px;">
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
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