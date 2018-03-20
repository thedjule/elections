@extends('layouts.app')

@section('content')

    @foreach($elections as $election)
        <div class="box">
            <article class="media">
                <div class="media-content">
                    <div class="content m-b-30">
                        <h3 class="has-text-weight-bold">
                            {{ $election->name }}
                            <a class="button is-primary is-small has-text-weight-normal m-l-10" href="{{route('results-elections', $election->id)}}">
                                <span>View Results</span>
                                <span class="icon">
                                  <i class="fa fa-angle-double-right"></i>
                                </span>
                            </a>
                        </h3>
                        <small>Processed: 325 / 3548</small>
                        <progress class="progress is-primary is-small" value="15" max="100">30%</progress>
                        <h4 class="subtitle">Electoral lists:</h4>
                        <ul>
                            @foreach($election->electoralLists as $electoralList)
                                <li><small>{{ $electoralList->number }}. {{ $electoralList->name }}</small></li>
                            @endforeach
                        </ul>

                    </div>

                </div>
            </article>
        </div>
    @endforeach

@endsection