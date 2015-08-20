<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmDMCARequest;
use App\Provider;
use Illuminate\Contracts\Auth\Guard;
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

    /**
     * Ask user to confirm the data submitted
     * @param ConfirmDMCARequest $request
     * @param Guard $auth
     * @return \Illuminate\View\View
     */
    public function confirm (ConfirmDMCARequest $request, Guard $auth) {


        $template = $this->CompileDCMA($request->all(), $auth);

        return view('notices.confirm', compact('template'));
    }

    /**
     * Compile the DCMA form from the data and make a template
     * @param $data
     * @param Guard $auth
     * @return mixed
     * @internal param ConfirmDMCARequest $request
     */
    public function CompileDCMA($data, Guard $auth)
    {
        $data = $data + [
                'name'  => $auth->user()->name,
                'email' => auth()->user()->email
            ];
        $template = view()->file(app_path('Http/Templates/template.blade.php'), $data);

        return $template;
    }
}
