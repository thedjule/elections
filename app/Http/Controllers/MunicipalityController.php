<?php

namespace App\Http\Controllers;

use App\ElectoralList;
use App\Municipality;
use App\PollingStation;
use App\User;
use Illuminate\Http\Request;
use Session;
use Auth;

class MunicipalityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $municipality = Municipality::findOrFail($id);
        if(PollingStation::where('municipality_id', $id)->where('valid_save', 2)->first()) {
            $reportValid = true;
        } else {
            $reportValid = false;
        }

        return view('manage.elections.municipalities.show', compact('municipality', 'reportValid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $municipality = Municipality::findOrFail($id);

        $users = User::whereHas('roles', function($q){
            $q->where('name', 'administrator');
        })->get();

        if(!$userId = $municipality->user_id) $userId = '-1';

        return view('manage.elections.municipalities.edit', compact('municipality', 'users', 'userId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $municipality = Municipality::findOrFail($id);
        $municipality->user_id = $request->user;

        if($municipality->save()){
            Session::flash('success', 'Municipality has been successfully edited');
            return redirect()->route('elections.show', $municipality->election_id);
        } else {
            return redirect()->route('municipalities.edit', $municipality->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Create a Report at the end of the Elections.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewReport()
    {
        if(Auth::user()->hasRole('superadministrator|administrator')) {
            $municipality = Municipality::where('user_id', Auth::id())->first();
            if($municipality) {

                $electoralLists = ElectoralList::where('election_id', $municipality->election_id)->get();

                $registered = $municipality->pollingStations()->sum('registered');
                $inTotal = $municipality->pollingStations()->sum('in_total');
                $valid = $municipality->pollingStations()->sum('valid');
                $invalid = $municipality->pollingStations()->sum('invalid');
                $votedAtThePollingStation = $municipality->pollingStations()->sum('voted_at_the_polling_station');
                $votedOutOfThePollingStation = $municipality->pollingStations()->sum('voted_out_of_the_polling_station');
                $received = $municipality->pollingStations()->sum('received');
                $unused = $municipality->pollingStations()->sum('unused');
                $used = $municipality->pollingStations()->sum('used');
                $controlCoupons = $municipality->pollingStations()->sum('control_coupons');
                $trimConfirmations = $municipality->pollingStations()->sum('trim_confirmations');

                $electoralListsSum = [];

                foreach($municipality->pollingStations as $pollingStation) {
                    $index = 0;
                    foreach($pollingStation->electoralLists as $electoralList) {
                        if (empty($electoralListsSum[$index])) $electoralListsSum[$index] = 0;
                        $electoralListsSum[$index] += $electoralList->pivot->votes;
                        $index++;
                    }
                }

                return view('manage.elections.municipalities.report',
                    compact(
                        'municipality', 'electoralLists', 'registered', 'inTotal', 'valid', 'invalid',
                        'received', 'controlCoupons', 'trimConfirmations', 'unused', 'used', 'votedAtThePollingStation',
                        'votedOutOfThePollingStation', 'electoralListsSum'
                    ));

            }
        }
    }
}
