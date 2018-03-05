@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Polling Stations</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('polling-stations.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <span>New Polling Station</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
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
                    <a class="button is-danger is-small" @click="deletePollingStation({{$pollingStation->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $pollingStations->links() }}
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deletePollingStation: function(id) {
                    let app = this
                    axios.delete('/manage/polling-stations/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('Polling Station could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection