<div class="row gallery-archive">
    <div class="container">
        <div class="row" style="margin:20px 0">

            <?php if(sizeof($category->posts)): ?>
                <?php foreach($category->posts as $post): ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="<?php echo e($post->say('gallery_link')); ?>" class="thumbnail">
                            <img class="media-object" src="<?php echo e($post->say('featured_image')); ?>" alt="<?php echo e($post->title); ?>">
                            <span class="media-title"><?php echo e($post->title); ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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