<?php

namespace App\Http\Controllers;

use App\ElectoralList;
use App\Municipality;
use App\Election;


class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elections = Election::all();
        return view('results.index', compact('elections'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showElection($id)
    {
        $elections = Election::where('id', $id)->with('municipalities', 'electoralLists')->first();
        return view('results.elections', compact('elections'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMunicipality($id)
    {
        $municipality = Municipality::where('id', $id)->with('pollingStations')->first();
        $electoralLists = ElectoralList::where('election_id', $municipality->election_id)->get();
        return view('results.municipality', compact('municipality', 'electoralLists'));
    }
}
