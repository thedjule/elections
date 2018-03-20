@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">{{ $pollingStation->name }}</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a href="{{ route('municipalities.show', $pollingStation->municipality_id) }}">
                <span class="icon">
                  <i class="fa fa-angle-double-left"></i>
                </span>
                    <span>{{ $pollingStation->municipality->name }}</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">

    <div class="content">
        <p><strong>Received requests via letter:</strong> {{ $pollingStation->received_requests_via_letter }}</p>
        <p><strong>Voters allowed to vote by letter:</strong> {{ $pollingStation->voters_allowed_to_vote_by_letter }}</p>
        <p><strong>Voters not allowed to vote by letter:</strong> {{ $pollingStation->voters_not_allowed_to_vote_by_letter }}</p>
        <p><strong>Received:</strong> {{ $pollingStation->received }}</p>
        <p><strong>Unused:</strong> {{ $pollingStation->unused }}</p>
        <p><strong>Used:</strong> {{ $pollingStation->used }}</p>
        <p><strong>Control coupons:</strong> {{ $pollingStation->control_coupons }}</p>
        <p><strong>Trim confirmations:</strong> {{ $pollingStation->trim_confirmations }}</p>
        <p><strong>Valid:</strong> {{ $pollingStation->valid }}</p>
        <p><strong>Invalid:</strong> {{ $pollingStation->invalid }}</p>
        <ul>
            @foreach($pollingStation->electoralLists as $electoralList)
                <li>{{ $electoralList->number }}. {{ $electoralList->name }}: {{ $electoralList->pivot->votes }}</li>
            @endforeach
        </ul>
        <p><strong>Registered:</strong> {{ $pollingStation->registered }} ({{ $pollingStation->registered_check }})</p>
        <p><strong>Voted at the polling station:</strong> {{ $pollingStation->voted_at_the_polling_station }}</p>
        <p><strong>Voted out of the polling station:</strong> {{ $pollingStation->voted_out_of_the_polling_station }}</p>
        <p><strong>In total:</strong> {{ $pollingStation->in_total }}</p>
    </div>

@endsection