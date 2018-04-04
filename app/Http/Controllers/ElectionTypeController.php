<?php

namespace App\Http\Controllers;

use App\ElectionType;
use Illuminate\Http\Request;
use Session;

class ElectionTypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:superadministrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $electionTypes = ElectionType::all();
        return view('manage.election_types.index', compact('electionTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.election_types.create');
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

        $electionType = new ElectionType();
        $electionType->name = $request->name;

        if($electionType->save()){
            Session::flash('success', 'Election Type has been successfully added');
            return redirect()->route('electionTypes.index');
        } else {
            return redirect()->route('electionTypes.create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $electionType = ElectionType::findOrFail($id);
        return view('manage.election_types.edit', compact('electionType'));
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

        $electionType = ElectionType::findOrFail($id);
        $electionType->name = $request->name;

        if($electionType->save()){
            Session::flash('success', 'Election Type has been successfully edited');
            return redirect()->route('electionTypes.index');
        } else {
            return redirect()->route('electionTypes.edit', $electionType->id);
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
