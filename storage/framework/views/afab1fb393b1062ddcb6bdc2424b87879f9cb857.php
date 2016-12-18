<div class="col-xs-12 col-sm-4">
    <?php if(sizeof($iran_news)): ?>
        <h4><?php echo e(trans('site.global.news')); ?> <?php echo e(trans('site.know_menu.iran_procurement')); ?></h4>
        <ul class="news list-unstyled">
            <?php foreach($iran_news as $one_news): ?>
                <li>
                    <a href="<?php echo e($one_news->say('link')); ?>"><?php echo App\Providers\AppServiceProvider::pd(($one_news->say('title_limit'))) ?></a>
                    <span class="date"><?php echo App\Providers\AppServiceProvider::pd((jDate::forge($one_news->published_at)->format('Y F d'))) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>