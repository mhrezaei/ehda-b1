<?php echo Html::script ('assets/site/js/featherlight.min.js'); ?>

<?php echo Html::script ('assets/site/js/featherlight.gallery.min.js'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<div class="row gallery-archive">
    <div class="container">
        <div class="row">
            <div class="flex_wrapper" id="gallery">
                <?php if(sizeof(json_decode($gallery->meta('post_photos'), true))): ?>
                    <?php
                    $array = [];
                    $count = 1;
                    for ($i = 0; $i < count(json_decode($gallery->meta('post_photos'), true)); $i++) {
                        $array[] = (8 * $i) + 5;
                    }
                    ?>
                    <?php foreach(json_decode($gallery->meta('post_photos'), true) as $key => $pic): ?>
                        <?php
                        $image = explode('/', $pic['src']);
                        $image_thumbs = str_replace($image[count($image) - 1], 'thumbs/' . $image[count($image) - 1], $pic['src']);
                        ?>
                        <?php if(in_array($count, $array)): ?>
                            <div class="flex-item" id="<?php echo e($count); ?>"></div>
                            <?php $count++; ?>
                        <?php endif; ?>
                        <div class="flex-item" id="<?php echo e($count); ?>">
                            <a href="<?php echo e(url('') . $pic['src']); ?>" class="inner">
                                <img src="<?php echo e(url('') . $image_thumbs); ?>" alt="<?php echo e($pic['label']); ?>"
                                     style="width: 300px; height: 300px;">
                            </a>
                        </div>
                        <?php $count++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
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