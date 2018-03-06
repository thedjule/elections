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
    </div>

@endsection