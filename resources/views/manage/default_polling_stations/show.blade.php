@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Polling Station</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-info" href="{{route('default-polling-stations.edit', $pollingStation->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Polling Station</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <hr class="m-t-5">
        <p>
            <strong>Name:</strong> {{ $pollingStation->name }}
        </p>
        <p>
            <strong>Municipality:</strong> {{ $pollingStation->defaultMunicipality->name }}
        </p>
        <p>
            <strong>Registered:</strong> {{ $pollingStation->registered }}
        </p>
    </div>

@endsection