<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function changeRole(Request $request) {
        session()->put('role', $request->role);

        return redirect()->back();
    }
}
