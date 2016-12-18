<div class="col-xs-12 col-md-4">
    <ul class="list-unstyled clearfix">
        <div class="col-xs-6">
            <li><a href="<?php echo e(url('')); ?>"><?php echo e(trans('site.global.home_page')); ?></a></li>
            <li><a href="<?php echo e(url('/organ_donation_card')); ?>"><?php echo e(trans('site.know_menu.organ_donation_card')); ?></a></li>
            <li><a href="<?php echo e(url('/showPost/ngo_history/' . urlencode(trans('site.ability_menu.about_us')))); ?>"><?php echo e(trans('site.ability_menu.about_us')); ?></a></li>
        </div>
        <div class="col-xs-6">
            <li><a href="<?php echo e(url('/showPost/organ_donation_volunteer/' . urlencode(trans('site.ask_menu.organ_donation_volunteers')))); ?>"><?php echo e(trans('site.ask_menu.organ_donation_volunteers')); ?></a></li>
            <li><a href="/"><?php echo e(trans('site.ability_menu.gallery')); ?></a></li>
            <li><a href="/"><?php echo e(trans('site.ability_menu.photo_donors')); ?></a></li>
        </div>
    </ul>
</div>