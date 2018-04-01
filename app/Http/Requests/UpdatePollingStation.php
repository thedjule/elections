<?php

namespace App\Http\Requests;

use App\Rules\InTotal;
use App\Rules\Received;
use App\Rules\ReceivedRequestsViaLetter;
use App\Rules\Registered;
use App\Rules\Used;
use App\Rules\UsedCoupons;
use App\Rules\UsedVoted;
use App\Rules\Valid;
use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Request;

class UpdatePollingStation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = Request::all();
        if(empty($request['valid_save']))
            return [
                'received_requests_via_letter' => ['required', new ReceivedRequestsViaLetter($request['voters_allowed_to_vote_by_letter'], $request['voters_not_allowed_to_vote_by_letter'])],
                'voters_allowed_to_vote_by_letter' => 'required',
                'voters_not_allowed_to_vote_by_letter' => 'required',
                'received' => ['required', new Received($request['used'], $request['unused'], $request['registered_check'])],
                'unused' => 'required',
                'used' => ['required',
                    new Used($request['valid'], $request['invalid']),
                    new UsedVoted($request['voted_at_the_polling_station'], $request['voted_out_of_the_polling_station']),
                    new UsedCoupons($request['control_coupons'], $request['trim_confirmations'])],
                'control_coupons' => 'required',
                'trim_confirmations' => 'required',
                'valid' => ['required', new Valid($request['list'])],
                'invalid' => 'required',
                'registered' => ['required', new Registered($request['registered_check'])],
                'voted_at_the_polling_station' => 'required',
                'voted_out_of_the_polling_station' => 'required',
                'in_total' => ['required', new InTotal($request['used'])],
                'list.*' => 'required',
            ];
        else
            return [
                'received_requests_via_letter' => 'required_without:valid_save',
                'voters_allowed_to_vote_by_letter' => 'required_without:valid_save',
                'voters_not_allowed_to_vote_by_letter' => 'required_without:valid_save',
                'received' => 'required_without:valid_save',
                'unused' => 'required_without:valid_save',
                'used' => 'required_without:valid_save',
                'control_coupons' => 'required_without:valid_save',
                'trim_confirmations' => 'required_without:valid_save',
                'valid' => 'required_without:valid_save',
                'invalid' => 'required_without:valid_save',
                'registered' => 'required_without:valid_save',
                'voted_at_the_polling_station' => 'required_without:valid_save',
                'voted_out_of_the_polling_station' => 'required_without:valid_save',
                'in_total' => 'required_without:valid_save',
                'list.*' => 'required_without:valid_save',
            ];
    }
}
