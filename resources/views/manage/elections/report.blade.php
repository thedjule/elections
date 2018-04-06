@foreach($municipalities as $municipality)
    <table>
        <thead>
            <tr>
                <th>{{ $municipality->name }}</th>
                <th>received_requests_via_letter</th>
                <th>voters_allowed_to_vote_by_letter</th>
                <th>voters_not_allowed_to_vote_by_letter</th>
                <th>received</th>
                <th>unused</th>
                <th>used</th>
                <th>control_coupons</th>
                <th>trim_confirmations</th>
                <th>valid</th>
                <th>invalid</th>
                <th>registered</th>
                <th>registered_check</th>
                <th>voted_at_the_polling_station</th>
                <th>voted_out_of_the_polling_station</th>
                <th>in_total</th>
                @foreach($electoralLists as $electoralList)
                    <th>{{ $electoralList->number }}. {{ $electoralList->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($municipality->pollingStations as $pollingStation)
            <tr>
                <td>{{ $pollingStation->name }}</td>
                <td>{{ $pollingStation->received_requests_via_letter }}</td>
                <td>{{ $pollingStation->voters_allowed_to_vote_by_letter }}</td>
                <td>{{ $pollingStation->voters_not_allowed_to_vote_by_letter }}</td>
                <td>{{ $pollingStation->received }}</td>
                <td>{{ $pollingStation->unused }}</td>
                <td>{{ $pollingStation->used }}</td>
                <td>{{ $pollingStation->control_coupons }}</td>
                <td>{{ $pollingStation->trim_confirmations }}</td>
                <td>{{ $pollingStation->valid }}</td>
                <td>{{ $pollingStation->invalid }}</td>
                <td>{{ $pollingStation->registered }}</td>
                <td>{{ $pollingStation->registered_check }}</td>
                <td>{{ $pollingStation->voted_at_the_polling_station }}</td>
                <td>{{ $pollingStation->voted_out_of_the_polling_station }}</td>
                <td>{{ $pollingStation->in_total }}</td>
                @foreach($pollingStation->electoralLists as $electoralList)
                    <td>{{ $electoralList->pivot->votes }}</td>
                @endforeach
            </tr>
        @endforeach
        <tr>
            <td>Sum: </td>
            <td>{{ $municipality->pollingStations->sum('received_requests_via_letter') }}</td>
            <td>{{ $municipality->pollingStations->sum('voters_allowed_to_vote_by_letter') }}</td>
            <td>{{ $municipality->pollingStations->sum('voters_not_allowed_to_vote_by_letter') }}</td>
            <td>{{ $municipality->pollingStations->sum('received') }}</td>
            <td>{{ $municipality->pollingStations->sum('unused') }}</td>
            <td>{{ $municipality->pollingStations->sum('used') }}</td>
            <td>{{ $municipality->pollingStations->sum('control_coupons') }}</td>
            <td>{{ $municipality->pollingStations->sum('trim_confirmations') }}</td>
            <td>{{ $municipality->pollingStations->sum('valid') }}</td>
            <td>{{ $municipality->pollingStations->sum('invalid') }}</td>
            <td>{{ $municipality->pollingStations->sum('registered') }}</td>
            <td>{{ $municipality->pollingStations->sum('registered_check') }}</td>
            <td>{{ $municipality->pollingStations->sum('voted_at_the_polling_station') }}</td>
            <td>{{ $municipality->pollingStations->sum('voted_out_of_the_polling_station') }}</td>
            <td>{{ $municipality->pollingStations->sum('in_total') }}</td>
        </tr>
        <tr></tr>
        </tbody>
    </table>
@endforeach
