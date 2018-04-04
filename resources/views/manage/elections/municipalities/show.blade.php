@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <div class="level-item">
                <p class="title">{{ $municipality->name }}</p>
            </div>
            <div class="level-item">
                @if($reportValid)
                    <a class="button is-text" href="{{route('manage.report')}}">
                        <span class="icon">
                            <i class="fa fa-file"></i>
                        </span>
                        <span>View Report</span>
                    </a>
                @else
                    <a class="button is-text" disabled style="text-decoration: unset;">
                        <span class="icon">
                            <i class="fa fa-exclamation-circle"></i>
                        </span>
                        <span>View Report</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                @if (Auth::user()->hasRole('superadministrator'))
                    <a href="{{ route('elections.show', $municipality->election_id) }}">
                    <span class="icon">
                      <i class="fa fa-angle-double-left"></i>
                    </span>
                        <span>{{ $municipality->election->name }}</span>
                    </a>
                @else
                    <span>{{ $municipality->election->name }}</span>
                @endif
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th></th>
            <th><small>Polling Station</small></th>
            <th><small>Received</small></th>
            <th><small>Valid / Invalid</small></th>
            <th><small>In Total</small></th>
            <th><small>Registered</small></th>
            @if (Auth::user()->hasRole('superadministrator'))
                <th></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($municipality->pollingStations as $pollingStation)
            <tr>
                <td class="has-text-left">
                    @if($pollingStation->valid_save == 0)
                        <a class="button is-info is-small" href="{{ route('polling-stations.edit', $pollingStation->id) }}">
                            <span class="icon">
                              <i class="fa fa-edit"></i>
                            </span>
                            <span>Edit</span>
                        </a>
                    @endif
                    @if($pollingStation->valid_save == 1)
                        <a class="button is-warning is-small" href="{{ route('polling-stations.edit', $pollingStation->id) }}">
                        <span class="icon">
                          <i class="fa fa-exclamation-triangle"></i>
                        </span>
                            <span>Edit</span>
                        </a>
                    @endif
                    @if($pollingStation->valid_save == 2)
                        <a class="button is-success is-small" href="{{ route('polling-stations.edit', $pollingStation->id) }}">
                        <span class="icon">
                          <i class="fa fa-check"></i>
                        </span>
                            <span>Edit</span>
                        </a>
                    @endif
                </td>
                <td><a href="{{ route('polling-stations.show', $pollingStation->id) }}" class="has-text-black"><small>{{$pollingStation->name}}</small></a></td>
                <td><small>{{ $pollingStation->received }}</small></td>
                <td><small>{{ $pollingStation->valid }} / {{ $pollingStation->invalid }}</small></td>
                <td><small>{{ $pollingStation->in_total }}</small></td>
                <td><small>{{ $pollingStation->registered }}</small></td>
                @if (Auth::user()->hasRole('superadministrator'))
                    <td class="has-text-right">
                        @if($pollingStation->user)
                            <a class="button is-text is-small" href="{{route('users.show', $pollingStation->user_id)}}" style="text-decoration: unset;">
                                <span class="icon">
                                  <i class="fa fa-user"></i>
                                </span>
                                <span>{{ $pollingStation->user->name }}</span>
                                <span class="icon">
                                  <i class="fa fa-angle-double-right"></i>
                                </span>
                            </a>
                        @else
                            <a class="button is-text is-small has-text-danger" style="text-decoration: unset;">
                                <span class="icon">
                                  <i class="fa fa-user-times has-text-danger"></i>
                                </span>
                                <span>No User</span>
                            </a>
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection