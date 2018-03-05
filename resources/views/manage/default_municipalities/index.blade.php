@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Municipalities</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('municipalities.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <span>New Municipality</span>
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
        @foreach($municipalities as $municipality)
            <tr>
                <td><small><strong><a href="{{route('municipalities.show', $municipality->id)}}">{{$municipality->name}}</a></strong></small></td>
                <td>
                    <div class="is-right buttons">
                        <a href="{{route('municipalities.edit', $municipality->id)}}" class="button is-info is-small">
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>
                            <span>Edit</span>
                        </a>
                        <a class="button is-danger is-small" @click="deleteMunicipality({{$municipality->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deleteMunicipality: function(id) {
                    let app = this
                    axios.delete('/manage/municipalities/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('Municipality could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection