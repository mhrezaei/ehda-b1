<div class="col-xs-12 col-sm-4">
    <?php if(sizeof($ngo_news)): ?>
        <h4><?php echo e(trans('site.global.news')); ?> <?php echo e(trans('site.know_menu.internal-ngo')); ?></h4>
        <ul class="news list-unstyled">
            <?php foreach($ngo_news as $one_news): ?>
                <li>
                    <a href="<?php echo e($one_news->say('link')); ?>"><?php echo App\Providers\AppServiceProvider::pd(($one_news->say('title_limit'))) ?></a>
                    <span class="date" style="font-size: 11px;"><?php echo App\Providers\AppServiceProvider::pd((jDate::forge($one_news->published_at)->format('d F Y'))) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <hr>
        <a href="<?php echo e(url('/archive/iran-news/internal-ngo')); ?>" class="left"><?php echo e(trans('site.global.more')); ?></a>
    <?php endif; ?>
</div>