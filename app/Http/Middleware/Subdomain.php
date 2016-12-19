<?php

namespace App\Http\Middleware;

use App\Models\Domain;
use App\Traits\GlobalControllerTrait;
use Closure;
use Illuminate\Support\Facades\Session;

class Subdomain
{
    use GlobalControllerTrait;
    public function handle($request, Closure $next)
    {
//        return $next($request); //@TODO: Remove This!
        if ($this->getDomain() == 'inspector')
        {
            return redirect('http://ehda.center/inspector');
        }
        elseif ($this->getDomain() == 'global')
        {
            Session::put('domain', 'global');
        }
        else
        {
            $domain = Domain::where('alias', $this->getDomain())->first();
            if ($domain)
            {
                Session::put('domain', $domain->slug);
            }
            else
            {
                Session::put('domain', 'global');
                return redirect('http://ehda.center'); //@TODO: Hadi, this restricts access from localhost!
            }
        }
        return $next($request);
    }
}
