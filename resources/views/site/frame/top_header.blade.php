<div class="row top-bar bg-primary clearfix">
	<ul class="pull-right list-inline no-margin">
		@if(Auth::check())
		<li class="has-child">
			<a href="/">{{ Auth::user()->name_first }} {{ trans('site.global.users_welcome_msg') }}</a>
			<ul class="list-unstyled bg-primary">
				<li><a href="{{ url('/members/my_card') }}">{{ trans('site.global.show_organ_donation_card') }}</a></li>
				<li><a href="{{ url('/card/show_card/full/' . encrypt(Auth::user()->code_melli) . '/download') }}">{{ trans('site.global.download_oragan_donation_card') }}</a></li>
				<li><a href="{{ url('/members/my_card/print') }}">{{ trans('forms.button.card_print') }}</a></li>
				<li><a href="{{ url('/members/my_card/edit') }}">{{ trans('site.global.users_edit_data') }}</a></li>
				<li><a href="{{ url('/logout') }}">{{ trans('site.global.log_out') }}</a></li>
			</ul>
		</li>
		@else
			<li>
				<a href="{{ url('/login') }}">{{ trans('site.global.users_login') }}</a>
			</li>
		@endif
		<li>
			<a href="{{ url('/login11') }}">{{ trans('site.global.stats_login') }}</a>
		</li>
	</ul>
	<a href="/" class="slogan pull-left">
		<span>{{ trans('site.global.organ_donation') }}</span><span>{{ trans('site.global.donate_life') }}</span>
	</a>
</div>
