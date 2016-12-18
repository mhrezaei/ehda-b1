<div class="main-menu clearfix">
    <a href="/" class="col-xs-12 col-sm-4 col-md-3">
        <h1>
            <img src="{{ url('assets') }}/site/images/header-logo.png" alt="{{ trans('global.siteTitle') }}" id="logo">
            <span class="hidden">{{ trans('global.siteTitle') }}</span>
        </h1>
    </a>
    <ul class="list-inline text-left">
        <li class="has-child">
            <a href="/">{{ trans('site.menu.know') }}</a>
            <ul class="bg-primary mega-menu col-xs-12">
                <ul class="list-unstyled pull-left text-right">
                    <h3>{{ trans('site.know_menu.world_news') }}</h3>
                    <li><a href="{{ url('/archive/word-news/world-opu-transplant') }}">{{ trans('site.know_menu.world_procurement') }}</a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3>{{ trans('site.know_menu.iran_news') }}</h3>
                    <li><a href="{{ url('/archive/iran-news/iran-opu-transplant') }}">{{ trans('site.know_menu.iran_procurement') }}</a></li>
                    <li><a href="{{ url('/archive/iran-news/internal-ngo') }}">{{ trans('site.know_menu.internal-ngo') }}</a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="{{ url('/faq') }}"> {{ trans('site.know_menu.faq') }}</a></h3>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3>{{ trans('site.know_menu.academic') }}</h3>
                    <li><a href="{{ url('/showPost/brain_death/' . urlencode(trans('site.know_menu.brain_death'))) }}">{{ trans('site.know_menu.brain_death') }}</a></li>
                    <li><a href="{{ url('/showPost/organ_donation/' . urlencode(trans('site.know_menu.organ_donation'))) }}">{{ trans('site.know_menu.organ_donation') }}</a></li>
                    <li><a href="{{ url('/showPost/allocation/' . urlencode(trans('site.know_menu.allocation'))) }}">{{ trans('site.know_menu.allocation') }}</a></li>
                    <li><a href="{{ url('/showPost/organ_transplant/' . urlencode(trans('site.know_menu.organ_transplant'))) }}">{{ trans('site.know_menu.organ_transplant') }}</a></li>
                    <li><a href="{{ url('/showPost/organ_transplant_history/' . urlencode(trans('site.know_menu.organ_transplant_history'))) }}">{{ trans('site.know_menu.organ_transplant_history') }}</a></li>
                    <li><a href="{{ url('/showPost/statistics/' . urlencode(trans('site.know_menu.statistics'))) }}">{{ trans('site.know_menu.statistics') }}</a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3>{{ trans('site.know_menu.cultural') }}</h3>
                    <li><a href="{{ url('/showPost/organ_donation_in_religion/' . urlencode(trans('site.know_menu.organ_donation_in_religion'))) }}">{{ trans('site.know_menu.organ_donation_in_religion') }}</a></li>
                    <li><a href="{{ url('/showPost/organ_donation_in_another_country/' . urlencode(trans('site.know_menu.organ_donation_in_another_country'))) }}">{{ trans('site.know_menu.organ_donation_in_another_country') }}</a></li>
                    <li><a href="{{ url('/organ_donation_card') }}">{{ trans('site.know_menu.organ_donation_card') }}</a></li>
                </ul>
            </ul>
        </li>
        <li class="has-child">
            <a href="/">{{ trans('site.menu.ask') }}</a>
            <ul class="bg-primary mega-menu col-xs-12">
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="{{ url('/showPost/donations/' . urlencode(trans('site.ask_menu.donations'))) }}"> {{ trans('site.ask_menu.donations') }}</a></h3>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3>{{ trans('site.ask_menu.volunteers') }}</h3>
                    <li><a href="/">{{ trans('site.ask_menu.special_volunteers') }}</a></li>
                    <li><a href="{{ url('/volunteers') }}">{{ trans('site.ask_menu.organ_donation_volunteers') }}</a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="{{ url('/showPost/participation_in_the_notification/' . urlencode(trans('site.ask_menu.participation_in_the_notification'))) }}"> {{ trans('site.ask_menu.participation_in_the_notification') }}</a></h3>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="{{ url('/showPost/supporters/' . urlencode(trans('site.ask_menu.supporters'))) }}"> {{ trans('site.ask_menu.supporters') }}</a></h3>
                </ul>
                <ul class="list-unstyled pull-left text-right" style="display: none;">
                    <h3>{{ trans('site.ask_menu.you_say') }}</h3>
                    <li><a href="/">{{ trans('site.ask_menu.your_works') }}</a></li>
                    <li><a href="/">{{ trans('site.ask_menu.your_memories') }}</a></li>
                    <li><a href="/">{{ trans('site.ask_menu.suggestions') }}</a></li>
                </ul>
            </ul>
        </li>
        <li class="has-child">
            <a href="/">{{ trans('site.menu.ability') }}</a>
            <ul class="bg-primary mega-menu col-xs-12">
                <ul class="list-unstyled pull-left text-right">
                    <h3>{{ trans('site.ability_menu.about_us') }}</h3>
                    <li><a href="{{ url('/showPost/ngo_history/' . urlencode(trans('site.ability_menu.ngo_history'))) }}">{{ trans('site.ability_menu.ngo_history') }}</a></li>
                    <li><a href="{{ url('/showPost/board_of_directories/' . urlencode(trans('site.ability_menu.board_of_directories'))) }}">{{ trans('site.ability_menu.board_of_directories') }}</a></li>
                    <li><a href="{{ url('/showPost/board_of_trustees/' . urlencode(trans('site.ability_menu.board_of_trustees'))) }}">{{ trans('site.ability_menu.board_of_trustees') }}</a></li>
                    <li><a href="{{ url('/showPost/founding/' . urlencode(trans('site.ability_menu.founding'))) }}">{{ trans('site.ability_menu.founding') }}</a></li>
{{--                    <li><a href="{{ url('/showPost/organizational_chart/' . urlencode(trans('site.ability_menu.organizational_chart'))) }}">{{ trans('site.ability_menu.organizational_chart') }}</a></li>--}}
{{--                    <li><a href="{{ url('/showPost/statute/' . urlencode(trans('site.ability_menu.statute'))) }}">{{ trans('site.ability_menu.statute') }}</a></li>--}}
{{--                    <li><a href="{{ url('/showPost/tasks_goals/' . urlencode(trans('site.ability_menu.tasks_goals'))) }}">{{ trans('site.ability_menu.tasks_goals') }}</a></li>--}}
                    <li><a href="{{ url('/showPost/committees/' . urlencode(trans('site.ability_menu.committees'))) }}">{{ trans('site.ability_menu.committees') }}</a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3>{{ trans('site.ability_menu.gallery') }}</h3>
                    <li><a href="{{ url('/gallery/categories/gallery') }}">{{ trans('site.ability_menu.pictures') }}</a></li>
                    <li><a href="/">{{ trans('site.ability_menu.films') }}</a></li>
                    <li><a href="{{ url('/angels') }}">{{ trans('site.ability_menu.photo_donors') }}</a></li>
                </ul>
                <ul class="list-unstyled pull-left text-right">
                    <h3><a href="/"> {{ trans('site.ability_menu.contact_us') }}</a></h3>
                </ul>
            </ul>
        </li>
    </ul>
</div>