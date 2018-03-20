@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Elections</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('elections.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <span>New Elections</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Status</th>
            <th>Municipality</th>
            <th>Date Created</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($elections as $election)
            <tr>
                <td><small><strong><a href="{{route('elections.show', $election->id)}}">{{ $election->name }}</a></strong></small></td>
                <td><small><strong>{{ $election->electionType->name }}</strong></small></td>
                <td>
                    <small>
                        <strong>
                            @switch($election->status)
                                @case(0)
                                    Setup
                                    @break
                                @case(1)
                                    In progress
                                    @break
                                @case(2)
                                    Finished
                                    @break
                            @endswitch
                        </strong>
                    </small>
                </td>
                <td><small>
                        @if(count($election->municipalities) > 1)
                            All
                        @else
                            @foreach($election->municipalities as $municipality)
                                {{ $municipality->name }}
                            @endforeach
                        @endif
                    </small></td>
                <td><small>{{ $election->created_at->format('j. M, Y. H:i:s') }}</small></td>
                <td>
                    <a href="{{route('elections.edit', $election->id)}}" class="button is-info is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                    <a href="{{route('results-elections', $election->id)}}" class="button is-link is-small">
                        <span>Results</span>
                        <span class="icon">
                            <i class="fa fa-angle-double-right"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $elections->links() }}
@endsection