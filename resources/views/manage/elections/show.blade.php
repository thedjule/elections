@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Elections</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-info" href="{{route('elections.edit', $election->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Elections</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <hr class="m-t-5">
        <p>
            <strong>Name:</strong> {{ $election->name }}
        </p>
        <p>
            <strong>Status:</strong>
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
        </p>
        <p>
            <strong>Type:</strong> {{ $election->electionType->name }}
        </p>
        <h3>Municipalities:</h3>
    </div>

    <div class="field is-grouped is-grouped-multiline m-b-30">
        @foreach($election->municipalities as $municipality)
            <div class="control">
                <div class="tags has-addons">
                    <a class="tag" href="{{route('municipalities.show', $municipality->id)}}">{{ $municipality->name }}</a>
                    @if($municipality->user_id)
                        <a class="tag is-success" href="{{route('users.show', $municipality->user_id)}}">
                            <span class="icon">
                              <i class="fa fa-user"></i>
                            </span>
                            <span>{{ $municipality->user->name }}</span>
                        </a>
                    @else
                        <a class="tag is-warning">No User</a>
                    @endif
                    <a class="tag is-info" href="{{route('municipalities.edit', $municipality->id)}}">Edit</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="content">
        <h3>Electoral Lists:</h3>
        @foreach($election->electoralLists as $electoralList)
            <p><small>{{ $electoralList->number }}. {{ $electoralList->name }}</small></p>
        @endforeach
    </div>
@endsection