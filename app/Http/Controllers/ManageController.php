<?php

namespace App\Http\Controllers;

use App\Municipality;
use App\PollingStation;
use Illuminate\Http\Request;
use Auth;

class ManageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|user');
    }

    public function index()
    {
        return redirect()->route('manage.dashboard');
    }

    public function dashboard()
    {
        if(Auth::user()->hasRole('administrator')) {
            $municipality = Municipality::where('user_id', Auth::id())->first();

            if(PollingStation::where('municipality_id', $municipality->id)->where('valid_save', 2)->first()) {
                $reportValid = true;
            } else {
                $reportValid = false;
            }

            return view('manage.elections.municipalities.show', compact('municipality', 'reportValid'));
        }

        if(Auth::user()->hasRole('user')) {
            $pollingStation = PollingStation::where('user_id', Auth::id())->first();
            return redirect()->route('polling-stations.edit', $pollingStation->id);
        }

        return view('manage.dashboard');
    }
}
