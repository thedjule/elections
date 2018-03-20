<?php

namespace App\Http\Controllers;

use App\Election;
use App\ElectoralList;
use Illuminate\Http\Request;
use Session;

class ElectoralListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $electoralLists = ElectoralList::orderBy('election_id')->paginate(15);
        return view('manage.electoral_lists.index', compact('electoralLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $elections = Election::all();
        return view('manage.electoral_lists.create', compact('elections'));
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
            'number' => 'required|numeric',
            'name' => 'required|min:3|max:255',
            'election' => 'required'
        ]);

        $electoralList = new ElectoralList();
        $electoralList->number = $request->number;
        $electoralList->name = $request->name;
        $electoralList->election_id = $request->election;

        if($electoralList->save()){
            Session::flash('success', 'Electoarl List has been successfully added');
            return redirect()->route('electoral-lists.index');
        } else {
            return redirect()->route('electoral-lists.create');
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
        $electoralList = ElectoralList::findOrFail($id);
        return view('manage.electoral_lists.show', compact('electoralList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $electoralList = ElectoralList::findOrFail($id);
        $elections = Election::all();
        return view('manage.electoral_lists.edit', compact('electoralList', 'elections'));
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
            'number' => 'required|numeric',
            'name' => 'required|min:3|max:255',
            'election' => 'required'
        ]);

        $electoralList = ElectoralList::findOrFail($id);
        $electoralList->number = $request->number;
        $electoralList->name = $request->name;
        $electoralList->election_id = $request->election;

        if($electoralList->save()){
            Session::flash('success', 'Polling Stations has been successfully edited');
            return redirect()->route('electoral-lists.show', $electoralList->id);
        } else {
            return redirect()->route('electoral-lists.edit', $electoralList->id);
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
