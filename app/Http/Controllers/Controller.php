<?php

namespace PostCheck\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function currentUser()
    {
        if(! \Auth::check() ) {
            throw new \Exception('No user logged in');
        }

        return  \Auth::user();
    }
}
