<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmDMCARequest;
use App\Provider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NoticesController extends Controller
{
    /**
     *Create new instance of the notice
     */
    function __construct()
    {
        $this -> middleware('auth');
    }


    /**
     * Shows the home page of the controller
     * @return string
     */
    public function index(){

        return 'all';
    }

    /**
     * creating the DMCA form
     * @return \Illuminate\View\View
     */
    public function create (){

        //get list of providers
        $providers = Provider::lists('name', 'id');

        return view('notices.create',compact('providers'));
    }

    public function confirm (ConfirmDMCARequest $request) {

        return $request->all();
    }
}
