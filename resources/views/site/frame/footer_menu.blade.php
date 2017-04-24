<div class="col-xs-12 col-md-4">
    <ul class="list-unstyled clearfix">
        <div class="col-xs-6">
            <li><a href="{{ url('') }}">{{ trans('site.global.home_page') }}</a></li>
            <li><a href="{{ url('/organ_donation_card') }}">{{ trans('site.know_menu.organ_donation_card') }}</a></li>
            <li><a href="{{ url('/showPost/ngo_history/' . urlencode(trans('site.ability_menu.about_us'))) }}">{{ trans('site.ability_menu.about_us') }}</a></li>
        </div>
        <div class="col-xs-6">
            <li><a href="{{ url('/volunteers') }}">{{ trans('site.ask_menu.organ_donation_volunteers') }}</a></li>
            <li><a href="{{ url('/gallery/categories/gallery') }}">{{ trans('site.ability_menu.gallery') }}</a></li>
            <li><a href="{{ url('/angels') }}">{{ trans('site.ability_menu.photo_donors') }}</a></li>
        </div>
    </ul>
</div>