@extends('layouts.app')

@section('content')
    <div class="content">
        <h2 class="has-text-centered">{{ $elections->name }}</h2>
        <progress class="progress is-info is-small" value="{{ $registered }}" max="{{ $registeredCheck }}">{{ $registeredPercent }}%</progress>

        <hr>
    </div>

    <nav class="level is-mobile">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Processed {{ $registeredPercent }}%</p>
                <p class="title">{{ $registered }} / {{ $registeredCheck }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">In Total {{ $inTotalPercent }}%</p>
                <p class="title">{{ $inTotal }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Valid {{ $validPercent }}%</p>
                <p class="title">{{ $valid }}</p>
            </div>
        </div>
    </nav>

    <hr class="m-b-50">

    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th></th>
            <th><small>Processed</small></th>
            <th><small>In Total</small></th>
            <th><small>Valid</small></th>
            @foreach($elections->electoralLists as $electoralList)
                <th class="has-text-weight-bold">
                    <small>{{ $electoralList->name }}</small>
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @foreach($electoralListsPercent as $percent)
                <td>
                    <small>{{ $electoralListsSum[$loop->index] }}</small>
                    <span class="tag is-text">{{ $percent }} %</span>
                </td>
            @endforeach
        </tr>
        @foreach($elections->municipalities as $municipality)
            <tr>
                <td><small><strong><a href="{{ route('results-municipality', $municipality->id) }}">{{$municipality->name}}</a></strong></small></td>
                <td><small>{{ $municipality->pollingStations()->sum('registered') }} / {{ $municipality->pollingStations()->sum('registered_check') }}</small></td>
                <td><small>{{ $municipality->pollingStations()->sum('in_total') }}</small></td>
                <td><small>{{ $municipality->pollingStations()->sum('valid') }}</small></td>
                @foreach($results[$municipality->id] as $listValue)
                    <td><small>{{ $listValue }}</small></td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
