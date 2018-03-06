<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DefaultPollingStation;
use App\DefaultMunicipality;
use Session;

class DefaultPollingStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $pollingStations = DefaultPollingStation::with('defaultMunicipality')->orderBy('default_municipality_id')->get();
        $pollingStations = DefaultPollingStation::orderBy('default_municipality_id')->paginate(10);
        return view('manage.default_polling_stations.index', compact('pollingStations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipalities = DefaultMunicipality::all();
        return view('manage.default_polling_stations.create', compact('municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateWith([
            'name' => 'required|min:3|max:255',
            'municipality' => 'required',
            'registered' => 'required|numeric'
        ]);

        $pollingStation = new DefaultPollingStation();
        $pollingStation->name = $request->name;
        $pollingStation->default_municipality_id = $request->municipality;
        $pollingStation->registered = $request->registered;

        if($pollingStation->save()){
            Session::flash('success', 'Polling Stations has been successfully added');
            return redirect()->route('default-polling-stations.index');
        } else {
            return redirect()->route('default-polling-stations.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pollingStation = DefaultPollingStation::findOrFail($id);
        return view('manage.default_polling_stations.show', compact('pollingStation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pollingStation = DefaultPollingStation::findOrFail($id);
        $municipalities = DefaultMunicipality::all();
        return view('manage.default_polling_stations.edit', compact('pollingStation', 'municipalities'));
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
        $this->validateWith([
            'name' => 'required|min:3|max:255',
            'municipality' => 'required',
            'registered' => 'required|numeric'
        ]);

        $pollingStation = DefaultPollingStation::findOrFail($id);
        $pollingStation->name = $request->name;
        $pollingStation->default_municipality_id = $request->municipality;
        $pollingStation->registered = $request->registered;

        if($pollingStation->save()){
            Session::flash('success', 'Polling Stations has been successfully edited');
            return redirect()->route('default-polling-stations.show', $pollingStation->id);
        } else {
            return redirect()->route('default-polling-stations.edit', $pollingStation->id);
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
        DefaultPollingStation::destroy($id);
    }
}
