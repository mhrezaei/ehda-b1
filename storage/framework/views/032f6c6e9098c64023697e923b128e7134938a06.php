<div class="main-menu clearfix">
    <a href="/" class="col-xs-12 col-sm-4 col-md-3">
        <h1>
            <img src="<?php echo e(url('assets')); ?>/site/images/header-logo.png" alt="<?php echo e(trans('global.siteTitle')); ?>" id="logo">
            <span class="hidden"><?php echo e(trans('global.siteTitle')); ?></span>
        </h1>
    </a>
    <ul class="list-inline text-left">
        <li class="has-child">
            <a href="/"><?php echo e(trans('site.menu.know')); ?></a>
            <ul class="bg-primary mega-menu col-xs-12">
                <ul class="list-unstyled pull-left text-right">
                    <h3><?php echo e(trans('site.know_menu.world_news')); ?></h3>
                    <li><a href="<?php echo e(url('/archive/word-news/world-opu-transplant')); ?>"><?php echo e(trans('site.know_menu.world_procurement')); ?></a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><?php echo e(trans('site.know_menu.iran_news')); ?></h3>
                    <li><a href="<?php echo e(url('/archive/iran-news/iran-opu-transplant')); ?>"><?php echo e(trans('site.know_menu.iran_procurement')); ?></a></li>
                    <li><a href="<?php echo e(url('/archive/iran-news/internal-ngo')); ?>"><?php echo e(trans('site.know_menu.internal-ngo')); ?></a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="<?php echo e(url('/faq')); ?>"> <?php echo e(trans('site.know_menu.faq')); ?></a></h3>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><?php echo e(trans('site.know_menu.academic')); ?></h3>
                    <li><a href="<?php echo e(url('/showPost/brain_death/' . urlencode(trans('site.know_menu.brain_death')))); ?>"><?php echo e(trans('site.know_menu.brain_death')); ?></a></li>
                    <li><a href="<?php echo e(url('/showPost/organ_donation/' . urlencode(trans('site.know_menu.organ_donation')))); ?>"><?php echo e(trans('site.know_menu.organ_donation')); ?></a></li>
                    <li><a href="<?php echo e(url('/showPost/allocation/' . urlencode(trans('site.know_menu.allocation')))); ?>"><?php echo e(trans('site.know_menu.allocation')); ?></a></li>
                    <li><a href="<?php echo e(url('/showPost/organ_transplant/' . urlencode(trans('site.know_menu.organ_transplant')))); ?>"><?php echo e(trans('site.know_menu.organ_transplant')); ?></a></li>
                    <li><a href="<?php echo e(url('/showPost/organ_transplant_history/' . urlencode(trans('site.know_menu.organ_transplant_history')))); ?>"><?php echo e(trans('site.know_menu.organ_transplant_history')); ?></a></li>
                    <li><a href="<?php echo e(url('/showPost/statistics/' . urlencode(trans('site.know_menu.statistics')))); ?>"><?php echo e(trans('site.know_menu.statistics')); ?></a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><?php echo e(trans('site.know_menu.cultural')); ?></h3>
                    <li><a href="<?php echo e(url('/showPost/organ_donation_in_religion/' . urlencode(trans('site.know_menu.organ_donation_in_religion')))); ?>"><?php echo e(trans('site.know_menu.organ_donation_in_religion')); ?></a></li>
                    <li><a href="<?php echo e(url('/showPost/organ_donation_in_another_country/' . urlencode(trans('site.know_menu.organ_donation_in_another_country')))); ?>"><?php echo e(trans('site.know_menu.organ_donation_in_another_country')); ?></a></li>
                    <li><a href="<?php echo e(url('/organ_donation_card')); ?>"><?php echo e(trans('site.know_menu.organ_donation_card')); ?></a></li>
                </ul>
            </ul>
        </li>
        <li class="has-child">
            <a href="/"><?php echo e(trans('site.menu.ask')); ?></a>
            <ul class="bg-primary mega-menu col-xs-12">
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="<?php echo e(url('/showPost/donations/' . urlencode(trans('site.ask_menu.donations')))); ?>"> <?php echo e(trans('site.ask_menu.donations')); ?></a></h3>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><?php echo e(trans('site.ask_menu.volunteers')); ?></h3>
                    <li><a href="/"><?php echo e(trans('site.ask_menu.special_volunteers')); ?></a></li>
                    <li><a href="<?php echo e(url('/volunteers')); ?>"><?php echo e(trans('site.ask_menu.organ_donation_volunteers')); ?></a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="<?php echo e(url('/showPost/participation_in_the_notification/' . urlencode(trans('site.ask_menu.participation_in_the_notification')))); ?>"> <?php echo e(trans('site.ask_menu.participation_in_the_notification')); ?></a></h3>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="<?php echo e(url('/showPost/supporters/' . urlencode(trans('site.ask_menu.supporters')))); ?>"> <?php echo e(trans('site.ask_menu.supporters')); ?></a></h3>
                </ul>
                <ul class="list-unstyled pull-left text-right" style="display: none;">
                    <h3><?php echo e(trans('site.ask_menu.you_say')); ?></h3>
                    <li><a href="/"><?php echo e(trans('site.ask_menu.your_works')); ?></a></li>
                    <li><a href="/"><?php echo e(trans('site.ask_menu.your_memories')); ?></a></li>
                    <li><a href="/"><?php echo e(trans('site.ask_menu.suggestions')); ?></a></li>
                </ul>
            </ul>
        </li>
        <li class="has-child">
            <a href="/"><?php echo e(trans('site.menu.ability')); ?></a>
            <ul class="bg-primary mega-menu col-xs-12">
                <ul class="list-unstyled pull-left text-right">
                    <h3><?php echo e(trans('site.ability_menu.about_us')); ?></h3>
                    <li><a href="<?php echo e(url('/showPost/ngo_history/' . urlencode(trans('site.ability_menu.ngo_history')))); ?>"><?php echo e(trans('site.ability_menu.ngo_history')); ?></a></li>
                    <li><a href="<?php echo e(url('/showPost/board_of_directories/' . urlencode(trans('site.ability_menu.board_of_directories')))); ?>"><?php echo e(trans('site.ability_menu.board_of_directories')); ?></a></li>
                    <li><a href="<?php echo e(url('/showPost/board_of_trustees/' . urlencode(trans('site.ability_menu.board_of_trustees')))); ?>"><?php echo e(trans('site.ability_menu.board_of_trustees')); ?></a></li>
                    <li><a href="<?php echo e(url('/showPost/founding/' . urlencode(trans('site.ability_menu.founding')))); ?>"><?php echo e(trans('site.ability_menu.founding')); ?></a></li>
<?php /*                    <li><a href="<?php echo e(url('/showPost/organizational_chart/' . urlencode(trans('site.ability_menu.organizational_chart')))); ?>"><?php echo e(trans('site.ability_menu.organizational_chart')); ?></a></li>*/ ?>
<?php /*                    <li><a href="<?php echo e(url('/showPost/statute/' . urlencode(trans('site.ability_menu.statute')))); ?>"><?php echo e(trans('site.ability_menu.statute')); ?></a></li>*/ ?>
<?php /*                    <li><a href="<?php echo e(url('/showPost/tasks_goals/' . urlencode(trans('site.ability_menu.tasks_goals')))); ?>"><?php echo e(trans('site.ability_menu.tasks_goals')); ?></a></li>*/ ?>
                    <li><a href="<?php echo e(url('/showPost/committees/' . urlencode(trans('site.ability_menu.committees')))); ?>"><?php echo e(trans('site.ability_menu.committees')); ?></a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><?php echo e(trans('site.ability_menu.gallery')); ?></h3>
                    <li><a href="<?php echo e(url('/gallery/categories/gallery')); ?>"><?php echo e(trans('site.ability_menu.pictures')); ?></a></li>
                    <li><a href="/"><?php echo e(trans('site.ability_menu.films')); ?></a></li>
                    <li><a href="<?php echo e(url('/angels')); ?>"><?php echo e(trans('site.ability_menu.photo_donors')); ?></a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="/"> <?php echo e(trans('site.ability_menu.contact_us')); ?></a></h3>
                </ul>
            </ul>
        </li>
    </ul>
</div>