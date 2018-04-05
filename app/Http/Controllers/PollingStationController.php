<?php

namespace App\Http\Controllers;

use App\ElectoralList;
use App\Http\Requests\UpdatePollingStation;
use App\PollingStation;
use App\User;
use Illuminate\Http\Request;
use Session;
use Auth;

class PollingStationController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pollingStation = PollingStation::findOrFail($id);
        return view('manage.elections.polling_stations.show', compact('pollingStation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pollingStation = PollingStation::findOrFail($id);

        if (Auth::user()->owns($pollingStation->municipality, 'user_id') or Auth::user()->hasRole('superadministrator')) {
            if ($pollingStation->electoralLists->isEmpty()) {
                $electoralLists = ElectoralList::where('election_id', $pollingStation->municipality->election->id)->get();
                $pollingStation->electoralLists()->sync($electoralLists);
                return redirect()->route('polling-stations.edit', $pollingStation->id);
            }
            $electoralLists = $pollingStation->electoralLists;
            $users = User::whereHas('roles', function ($q) {
                $q->where('name', 'user');
            })->get();
            if (!$userId = $pollingStation->user_id) $userId = '-1';
            return view('manage.elections.polling_stations.edit', compact('pollingStation', 'electoralLists', 'users', 'userId'));
        } else {
            return redirect()->route('manage.dashboard');
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function addUser(Request $request, $id)
    {
        $pollingStation = PollingStation::findOrFail($id);
        $pollingStation->user_id = $request->user;

        if($pollingStation->save()){
            Session::flash('success', 'User has been successfully updated');
            return redirect()->route('municipalities.show', $pollingStation->municipality_id);
        } else {
            return redirect()->route('polling-stations.edit', $pollingStation->id);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePollingStation $request, $id)
    {
        $validated = $request->validated();

        $pollingStation = PollingStation::findOrFail($id);

        $pollingStation->received_requests_via_letter = $validated['received_requests_via_letter'];
        $pollingStation->voters_allowed_to_vote_by_letter = $validated['voters_allowed_to_vote_by_letter'];
        $pollingStation->voters_not_allowed_to_vote_by_letter = $validated['voters_not_allowed_to_vote_by_letter'];
        $pollingStation->received = $validated['received'];
        $pollingStation->unused = $validated['unused'];
        $pollingStation->used = $validated['used'];
        $pollingStation->control_coupons = $validated['control_coupons'];
        $pollingStation->trim_confirmations = $validated['trim_confirmations'];
        $pollingStation->valid = $validated['valid'];
        $pollingStation->invalid = $validated['invalid'];
        $pollingStation->registered = $validated['registered'];
        $pollingStation->voted_at_the_polling_station = $validated['voted_at_the_polling_station'];
        $pollingStation->voted_out_of_the_polling_station = $validated['voted_out_of_the_polling_station'];
        $pollingStation->in_total = $validated['in_total'];
        if(empty($request->get('valid_save')))
            $pollingStation->valid_save = 2;
        else
            $pollingStation->valid_save = 1;

        $electoralLists = [];
        foreach($validated['list'] as $pollingStationId => $votes) {
            $electoralLists[$pollingStationId] = ['votes' => $votes];
        }

        if($pollingStation->save()){
            $pollingStation->electoralLists()->sync($electoralLists);
            Session::flash('success', 'Polling Station has been successfully updated');
            return redirect()->route('polling-stations.show', $pollingStation->id);
        } else {
            return redirect()->route('polling-stations.edit', $pollingStation->id);
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
}
