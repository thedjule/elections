<?php

namespace App\Http\Controllers;

use App\DefaultPollingStation;
use Illuminate\Http\Request;
use App\DefaultMunicipality;
use Session;

class DefaultMunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipalities = DefaultMunicipality::all();
        return view('manage.default_municipalities.index', compact('municipalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.default_municipalities.create');
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
            'name' => 'required|min:3|max:255'
        ]);

        $municipality = new DefaultMunicipality();
        $municipality->name = $request->name;

        if($municipality->save()){
            Session::flash('success', 'Polling Stations has been successfully added');
            return redirect()->route('municipalities.index');
        } else {
            return redirect()->route('municipalities.create');
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
        $municipality = DefaultMunicipality::findOrFail($id);
        $pollingStations = DefaultPollingStation::where('default_municipality_id', $id)->paginate(20);
        return view('manage.default_municipalities.show', compact('municipality', 'pollingStations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $municipality = DefaultMunicipality::findOrFail($id);
        return view('manage.default_municipalities.edit', compact('municipality'));
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
            'name' => 'required|min:3|max:255'
        ]);

        $municipality = DefaultMunicipality::findOrFail($id);
        $municipality->name = $request->name;

        if($municipality->save()){
            Session::flash('success', 'Polling Stations has been successfully edited');
            return redirect()->route('municipalities.show', $municipality->id);
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
        DefaultMunicipality::destroy($id);
    }
}
