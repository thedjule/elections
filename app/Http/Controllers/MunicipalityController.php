<?php

namespace App\Http\Controllers;

use App\Municipality;
use App\User;
use Illuminate\Http\Request;
use Session;

class MunicipalityController extends Controller
{
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
        return view('manage.elections.municipalities.show', compact('municipality'));
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
}
