@extends('layouts.app')

@section('content')

    @foreach($elections as $election)
        <div class="box">
            <article class="media">
                <div class="media-content">
                    <div class="content m-b-30">
                        <nav class="level m-b-15">
                            <!-- Left side -->
                            <div class="level-left">
                                <div class="level-item">
                                    <h2 class="has-text-weight-bold is-5 m-t-15">
                                        {{ $election->name }}
                                    </h2>
                                </div>
                            </div>
                            <!-- Right side -->
                            <div class="level-right">
                                <div class="level-item">
                                    <p class="heading m-t-5">Processed: {{ $electionSum[$loop->index]['registered'] }} / {{ $electionSum[$loop->index]['registered_check'] }}</p>
                                </div>
                                <div class="level-item">
                                    <a class="button is-info has-text-weight-normal" href="{{route('results-elections', $election->id)}}">
                                        <span>View Results</span>
                                        <span class="icon">
                                      <i class="fa fa-chevron-circle-right"></i>
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </nav>
                        <progress class="progress is-small" value="{{ $electionSum[$loop->index]['registered'] }}" style="height: 5px;"
                                  max="{{ $electionSum[$loop->index]['registered_check'] }}"></progress>
                        <h4 class="subtitle m-t-50">Electoral lists:</h4>
                        <hr/>
                        @foreach($election->electoralLists as $electoralList)
                            <?php
                                $listSumVotes = $electoralList->pollingStations->sum('pivot.votes');
                                if($electionSum[$loop->parent->index]['valid'] > 0) {
                                    $listPercent = ($listSumVotes / $electionSum[$loop->parent->index]['valid']) * 100;
                                    $percent = number_format($listPercent, 2, ',', ' ');
                                } else {
                                    $percent = 0;
                                }
                            ?>
                            <div class="p-b-5">
                                <span><small>{{ $electoralList->number }}. {{ $electoralList->name }}</small></span>
                                <span class="tag is-light" style="float: right;">{{ $percent }} %</span>
                            </div>
                            <progress class="progress is-info is-small" value="{{ $listSumVotes }}" style="height: 5px;"
                                      max="{{ $electionSum[$loop->parent->index]['valid'] }}">{{ $percent }}</progress>
                        @endforeach
                    </div>
                </div>
            </article>
        </div>
    @endforeach

@endsection
