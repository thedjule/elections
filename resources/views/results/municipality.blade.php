@extends('layouts.app')

@section('content')
    <div class="content">
        <h1 class="has-text-centered">{{ $municipality->name }}</h1>
        <h5 class="has-text-centered"><small>{{ $municipality->election->name }}</small></h5>
        <progress class="progress is-info is-small" value="{{ $registeredSum }}" max="{{ $registeredCheckSum }}">{{ $registeredPercentSum }}%</progress>
        <hr>
    </div>


    <nav class="level is-mobile">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Processed</p>
                <p class="title">{{ $registeredSum }} / {{ $registeredCheckSum }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">%</p>
                <p class="title">{{ $registeredPercentSum }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">In Total</p>
                <p class="title">{{ $inTotalSum }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Valid</p>
                <p class="title">{{ $validSum }}</p>
            </div>
        </div>
    </nav>

    <hr class="m-b-50">

    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th></th>
            <th>Processed</th>
            <th>In Total</th>
            <th>Valid</th>
            @foreach($electoralLists as $electoralList)
                <th class="has-text-weight-bold"><small>{{ $electoralList->name }}</small></th>
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
                    <span class="tag is-light">{{ $percent }} %</span>
                </td>
            @endforeach
        </tr>
        @foreach($municipality->pollingStations as $pollingStation)
            <tr>
                <td><small>{{ $pollingStation->name }}</small></td>
                <td><small>{{ $pollingStation->registered }} / {{ $pollingStation->registered_check }}</small></td>
                <td><small>{{ $pollingStation->in_total }}</small></td>
                <td><small>{{ $pollingStation->valid }}</small></td>
                @foreach($pollingStation->electoralLists as $electoralList)
                    <td><small>{{ $electoralList->pivot->votes }}</small></td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
