<?php
namespace App\Traits;


trait GlobalControllerTrait
{
	public function getDomain()
	{
		$subdomain = str_replace('http://', '', url(''));
		$subdomain = str_replace('http://', '', $subdomain);
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
}