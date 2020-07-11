<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Adldap\Adldap;
use Adldap\Configuration\DomainConfiguration;
use Adldap\Models;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $provider = new Adldap;

        $config = new DomainConfiguration;

        $search = $provider->addProvider($config, 'default')->search();

        $users = $search->users()->first();

       /* $users->getAttributes()['cn'][0];

        $computer =  $search->computers()->find('itsec20mepg');
return $computer->getLastLogon();
        return date('d.m.Y H:i:s',$computer->getLastLogon());*/

        return view('home',compact('users'));
    }
}
