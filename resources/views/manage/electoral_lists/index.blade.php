@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Electoral Lists</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('electoral-lists.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <span>New Electoral List</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Number</th>
            <th>Name</th>
            <th>Elections</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($electoralLists as $electoralList)
            <tr>
                <td><small><strong>{{$electoralList->number}}</strong></small></td>
                <td><small><strong>{{$electoralList->name}}</strong></small></td>
                <td><small><strong>{{$electoralList->election->name}}</strong></small></td>
                <td>
                    <a href="{{route('electoral-lists.edit', $electoralList->id)}}" class="button is-info is-small">
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
    {{ $electoralLists->links() }}
@endsection