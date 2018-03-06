<?php

namespace App\Http\Controllers;

use App\Election;
use App\ElectionType;
use Illuminate\Http\Request;
use Session;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elections = Election::orderBy('id')->paginate(20);
        return view('manage.elections.index', compact('elections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $electionTypes = ElectionType::all();
        return view('manage.elections.create', compact('electionTypes'));
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
            'status' => 'required|numeric',
            'electionType' => 'required|numeric'
        ]);

        $election = new Election();
        $election->name = $request->name;
        $election->status = $request->status;
        $election->election_type_id = $request->electionType;

        if($election->save()){
            Session::flash('success', 'Elections have been successfully added');
            return redirect()->route('elections.index');
        } else {
            return redirect()->route('elections.create');
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
        $election = Election::findOrFail($id);
        return view('manage.elections.show', compact('election'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $election = Election::findOrFail($id);
        $electionTypes = ElectionType::all();
        return view('manage.elections.edit', compact('election', 'electionTypes'));
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
            'status' => 'required|numeric',
            'electionType' => 'required|numeric'
        ]);

        $election = Election::findOrFail($id);
        $election->name = $request->name;
        $election->status = $request->status;
        $election->election_type_id = $request->electionType;

        if($election->save()){
            Session::flash('success', 'Elections have been successfully edited');
            return redirect()->route('elections.show', $election->id);
        } else {
            return redirect()->route('elections.edit', $election->id);
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
