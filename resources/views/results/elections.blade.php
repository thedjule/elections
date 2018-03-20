@extends('layouts.app')

@section('content')
    <div class="content">
        <h2 class="has-text-centered">{{ $elections->name }}</h2>
        <progress class="progress is-info is-small" value="15" max="100">30%</progress>

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
            <th><small>Processed</small></th>
            <th><small>In Total</small></th>
            <th><small>Valid</small></th>
            @foreach($elections->electoralLists as $electoralList)
                <th class="has-text-weight-normal"><small>{{ $electoralList->name }}</small></th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($elections->municipalities as $municipality)
            <tr>
                <td><small><strong><a href="{{ route('results-municipality', $municipality->id) }}">{{$municipality->name}}</a></strong></small></td>
                <td><small>0 / 0</small></td>
                <td><small>0</small></td>
                <td><small>0</small></td>
                @foreach($elections->electoralLists as $electoralList)
                    <td><small>0</small></td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection