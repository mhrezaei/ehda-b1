<?php
namespace App\Traits;


use Illuminate\Support\Facades\Session;

trait GlobalControllerTrait
{
	public function getDomain()
	{
		$subdomain = str_replace('http://', '', url(''));
		$subdomain = str_replace('https://', '', $subdomain);
		$subdomain = explode('.', $subdomain);
		if ($subdomain[0] == 'www')
		{
			if ($subdomain[1] == 'ehda')
			{
				$subdomain = 'global';
			}
			else
			{
				$subdomain = $subdomain[1];
			}
		}
		else
		{
			if ($subdomain[0] == 'ehda')
			{
				$subdomain = 'global';
			}
			else
			{
				$subdomain = $subdomain[0];
			}
		}

		return $subdomain;
	}

	public function domain()
	{
		if (Session::has('domain'))
		{
			return Session::get('domain');
		}
		else
		{
			return 'global';
		}
	}
}