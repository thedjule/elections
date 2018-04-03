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

        $electionSum = [];

        foreach($elections as $key => $election) {
            foreach($election->municipalities as $municipality) {
                if(empty($electionSum[$key]['valid'])) {
                    $electionSum[$key]['valid'] = 0;
                    $electionSum[$key]['registered'] = 0;
                    $electionSum[$key]['registered_check'] = 0;
                }
                $electionSum[$key]['valid'] += $municipality->pollingStations->sum('valid');
                $electionSum[$key]['registered'] += $municipality->pollingStations->sum('registered');
                $electionSum[$key]['registered_check'] += $municipality->pollingStations->sum('registered_check');
            }
        }

        return view('results.index', compact('elections', 'electionSum'));
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

        $results = [];
        $registered = 0;
        $registeredCheck = 0;
        $inTotal = 0;
        $valid = 0;

        foreach ($elections->municipalities as $municipality) {
            $municipalityArray = [];
            $registered += $municipality->pollingStations->sum('registered');
            $registeredCheck += $municipality->pollingStations->sum('registered_check');
            $valid += $municipality->pollingStations->sum('valid');
            $inTotal += $municipality->pollingStations->sum('in_total');

            foreach ($elections->electoralLists as $electoralList) {
                array_push($municipalityArray, $electoralList->pollingStations()->whereIn('polling_station_id', $municipality->pollingStations->pluck('id'))->sum('votes'));
            }
            $results[$municipality->id] = $municipalityArray;
        }

        $numberOfLists = $elections->electoralLists->count();
        $electoralListsSum = [];
        $electoralListsPercent = [];

        foreach($results as $municipality) {
            for($i = 0; $i < $numberOfLists; $i++) {
                if(empty($electoralListsSum[$i])) $electoralListsSum[$i] = 0;
                $electoralListsSum[$i] += $municipality[$i];
            }
        }

        foreach($electoralListsSum as $key => $listSum) {
            if(empty($electoralListsPercent[$key])) $electoralListsPercent[$key] = 0;
            $listPercent = ($listSum / $valid) * 100;
            $electoralListsPercent[$key] = number_format($listPercent, 2, ',', ' ');
        }

        $registeredPercent = ($registered / $registeredCheck) * 100;
        $registeredPercent = number_format($registeredPercent, 2, ',', ' ');
        $inTotalPercent = ($inTotal / $registered) * 100;
        $inTotalPercent = number_format($inTotalPercent, 2, ',', ' ');
        $validPercent = ($valid / $inTotal) * 100;
        $validPercent = number_format($validPercent, 2, ',', ' ');

        return view('results.elections',
            compact('elections', 'results', 'registered', 'registeredCheck', 'inTotal', 'valid',
                'registeredPercent', 'electoralListsSum', 'electoralListsPercent', 'inTotalPercent', 'validPercent'
            ));
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

        $registeredSum = $municipality->pollingStations()->sum('registered');
        $registeredCheckSum = $municipality->pollingStations()->sum('registered_check');
        $inTotalSum = $municipality->pollingStations()->sum('in_total');
        $validSum = $municipality->pollingStations()->sum('valid');
        $registeredPercent = ($registeredSum / $registeredCheckSum) * 100;
        $registeredPercentSum = number_format($registeredPercent, 2, ',', ' ');

        $electoralListsSum = [];
        $electoralListsPercent = [];

        foreach($municipality->pollingStations as $pollingStation) {
            $index = 0;
            foreach($pollingStation->electoralLists as $electoralList) {
                if (empty($electoralListsSum[$index])) $electoralListsSum[$index] = 0;
                $electoralListsSum[$index] += $electoralList->pivot->votes;
                $index++;
            }
        }

        foreach($electoralListsSum as $key => $listSum) {
            if(empty($electoralListsPercent[$key])) $electoralListsPercent[$key] = 0;
            $listPercent = ($listSum / $validSum) * 100;
            $electoralListsPercent[$key] = number_format($listPercent, 2, ',', ' ');
        }

        return view('results.municipality',
            compact(
                'municipality', 'electoralLists', 'registeredSum', 'registeredCheckSum',
                'registeredPercentSum', 'inTotalSum', 'validSum', 'electoralListsSum', 'electoralListsPercent'
            ));
    }
}
