@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Municipality {{ $municipality->name }}</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-info" href="{{route('municipalities.edit', $municipality->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Municipality</span>
                </a>
            </div>
        </div>
    </nav>

    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Name</th>
            <th>Municipality</th>
            <th>Registered</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($pollingStations as $pollingStation)
            <tr>
                <td><small><strong>{{$pollingStation->name}}</strong></small></td>
                <td><small><strong>{{$pollingStation->defaultMunicipality->name}}</strong></small></td>
                <td><small><strong>{{$pollingStation->registered}}</strong></small></td>
                <td>
                    <a href="{{route('polling-stations.edit', $pollingStation->id)}}" class="button is-info is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $pollingStations->links() }}
@endsection