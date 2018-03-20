@extends('layouts.app')

@section('content')
    <div class="content">
        <h1 class="has-text-centered">{{ $municipality->name }}</h1>
        <h5 class="has-text-centered"><small>{{ $municipality->election->name }}</small></h5>
        <hr>
    </div>


    <nav class="level is-mobile">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Received</p>
                <p class="title">0</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Valid</p>
                <p class="title">0</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Registered</p>
                <p class="title">0</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">In Total</p>
                <p class="title">0</p>
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
                <th class="has-text-weight-normal"><small>{{ $electoralList->name }}</small></th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($municipality->pollingStations as $pollingStation)
            <tr>
                <td><small>{{$pollingStation->name}}</small></td>
                <td><small>0</small></td>
                <td><small>0</small></td>
                <td><small>0</small></td>
                @foreach($electoralLists as $electoralList)
                    <td><small>0</small></td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection