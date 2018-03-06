@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Electoral List</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-info" href="{{route('polling-stations.edit', $electoralList->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Electoral List</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <hr class="m-t-5">
        <p>
            <strong>Number:</strong> {{ $electoralList->number }}
        </p>
        <p>
            <strong>Elections:</strong> {{ $electoralList->name }}
        </p>
        <p>
            <strong>Name:</strong> {{ $electoralList->election->name }}
        </p>
    </div>

@endsection