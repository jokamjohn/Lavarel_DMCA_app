<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmDMCARequest;
use App\Notice;
use App\Provider;
use Auth;
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

        return Auth::user()->notices;
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


        $template = $this->CompileDCMA($data = $request->all(), $auth);

        //storing data in the session
        session()->flash('dcma', $data);

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

    /**
     * storing the new notice
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store (Request $request)
    {
        $this->createNotice($request);


        return redirect('notices');

    }

    /**
     * Create a new notice
     * @param Request $request
     */
    public function createNotice(Request $request)
    {
        //getting data from the session
        $data = session()->get('dcma');

        //creating a new notice, add the data to the notice
        $notice = Notice::open($data)
            ->useTemplate($request->input('template'));

        //Getting the user and user_id
        Auth::user()->notices()->save($notice);
    }
}
