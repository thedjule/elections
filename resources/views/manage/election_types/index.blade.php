@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Election Types</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('electionTypes.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <span>New Election Type</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($electionTypes as $electionType)
            <tr>
                <td><small><strong>{{ $electionType->name }}</strong></small></td>
                <td>
                    <div class="is-right buttons">
                        <a href="{{route('electionTypes.edit', $electionType->id)}}" class="button is-info is-small">
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>
                            <span>Edit</span>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
