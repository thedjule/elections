<?php

namespace App\Http\Controllers;

use App\DefaultMunicipality;
use App\DefaultPollingStation;
use App\Election;
use App\ElectionType;
use App\Municipality;
use App\PollingStation;
use Illuminate\Http\Request;
use Session;

class ElectionController extends Controller
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
        $municipalities = DefaultMunicipality::all();
        return view('manage.elections.create', compact('electionTypes', 'municipalities'));
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
            'electionType' => 'required|numeric',
            'municipalities' => 'required'
        ]);

        $election = new Election();
        $election->name = $request->name;
        $election->status = $request->status;
        $election->election_type_id = $request->electionType;

        if($election->save()){
            if(!empty($request->municipalities)) {
                $municipalities = [];
                $requestMunicipalities = explode(',', $request->municipalities);

                foreach ($requestMunicipalities as $value) {
                    $name = explode(':', $value);
                    array_push($municipalities, new Municipality(['name' => $name[1]]));
                }

                $election->municipalities()->saveMany($municipalities);

                foreach ($election->municipalities as $key => $municipality) {
                    $municipalityId = explode(':', $requestMunicipalities[$key]);
                    $defaultPollingStations = DefaultPollingStation::where('default_municipality_id', $municipalityId[0])->get();
                    if(!empty($defaultPollingStations)) {
                        $pollingStations = [];

                        foreach ($defaultPollingStations as $defaultPollingStation) {
                            array_push($pollingStations, new PollingStation(['name' => $defaultPollingStation->name, 'registered_check' => $defaultPollingStation->registered]));
                        }

                        $municipality->pollingStations()->saveMany($pollingStations);
                    }
                }
            }
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
        $election = Election::where('id', $id)->with('municipalities')->first();
        $electionTypes = ElectionType::all();
        $municipalities = DefaultMunicipality::all();
        return view('manage.elections.edit', compact('election', 'electionTypes', 'municipalities'));
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
            'electionType' => 'required|numeric',
            'municipalities' => 'required'
        ]);

        $election = Election::where('id', $id)->with('municipalities')->first();
        $election->name = $request->name;
        $election->status = $request->status;
        $election->election_type_id = $request->electionType;

        if($election->save()){
            $requestMunicipalities = explode(',', $request->municipalities);

            if(!empty($requestMunicipalities)) {
                $electionMunicipalities = [];
                foreach ($election->municipalities as $municipality) {
                    $electionMunicipalities += [$municipality->id => $municipality->name];
                }

                $municipalitiesToDelete = array_keys(array_diff($electionMunicipalities, $requestMunicipalities));
                if (!empty($municipalitiesToDelete)) {
                    $election->municipalities()->whereIn('id', $municipalitiesToDelete)->delete();
                }

                $municipalitiesToAdd = array_diff($requestMunicipalities, $electionMunicipalities);
                if (!empty($municipalitiesToAdd)) {
                    $municipalitiesToSave = [];
                    foreach ($municipalitiesToAdd as $value){
                        array_push($municipalitiesToSave, new Municipality(['name' => $value]));
                    }

                    $election->municipalities()->saveMany($municipalitiesToSave);

                    $defaultMunicipalities = DefaultMunicipality::whereIn('name', $municipalitiesToAdd)->get();
                    foreach($defaultMunicipalities as $defaultMunicipality) {
                        $defaultPollingStations = DefaultPollingStation::where('default_municipality_id', $defaultMunicipality->id)->get();
                        if(!empty($defaultPollingStations)) {
                            $pollingStations = [];

                            foreach ($defaultPollingStations as $defaultPollingStation) {
                                array_push($pollingStations, new PollingStation(['name' => $defaultPollingStation->name, 'registered_check' => $defaultPollingStation->registered]));
                            }
                            $municipality = $election->municipalities()->where('name', $defaultMunicipality->name)->first();
                            $municipality->pollingStations()->saveMany($pollingStations);
                        }
                    }
                }
            }
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
