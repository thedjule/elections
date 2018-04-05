@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Polling Station {{ $pollingStation->name }}</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('polling-stations.update', $pollingStation->id)}}" method="post" @keydown.enter.prevent>
                @method('PUT')
                @csrf

                @if (Auth::user()->hasRole('superadministrator'))
                    <div class="field m-b-30">
                        <a class="button is-primary" @click="cardModal()">
                            <span>Assign a User</span>
                            <span class="icon is-small is-right">
                                <i class="fa fa-user-circle-o"></i>
                            </span>
                        </a>
                        @if($pollingStation->user)
                            <span class="button is-text">
                                <span>{{ $pollingStation->user->name }}</span>
                            </span>
                        @endif
                    </div>
                @endif

                <div class="field">
                    <label class="label"><small>Received requests via letter:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('received_requests_via_letter') ? ' is-danger' : '' }}"
                               name="received_requests_via_letter" value="{{ old('received_requests_via_letter', $pollingStation->received_requests_via_letter) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('received_requests_via_letter'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('received_requests_via_letter'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('received_requests_via_letter') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Voters allowed to vote by letter:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('voters_allowed_to_vote_by_letter') ? ' is-danger' : '' }}"
                               name="voters_allowed_to_vote_by_letter" value="{{ old('voters_allowed_to_vote_by_letter', $pollingStation->voters_allowed_to_vote_by_letter) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('voters_allowed_to_vote_by_letter'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('voters_allowed_to_vote_by_letter'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('voters_allowed_to_vote_by_letter') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Voters not allowed to vote by letter:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('voters_not_allowed_to_vote_by_letter') ? ' is-danger' : '' }}"
                               name="voters_not_allowed_to_vote_by_letter" value="{{ old('voters_not_allowed_to_vote_by_letter', $pollingStation->voters_not_allowed_to_vote_by_letter) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('voters_not_allowed_to_vote_by_letter'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('voters_not_allowed_to_vote_by_letter'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('voters_not_allowed_to_vote_by_letter') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Received:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('received') ? ' is-danger' : '' }}"
                               name="received" value="{{ old('received', $pollingStation->received) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('received'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('received'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('received') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Unused:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('unused') ? ' is-danger' : '' }}"
                               name="unused" value="{{ old('unused', $pollingStation->unused) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('unused'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('unused'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('unused') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Used:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('used') ? ' is-danger' : '' }}"
                               name="used" value="{{ old('used', $pollingStation->used) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('used'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('used'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('used') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Control coupons:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('control_coupons') ? ' is-danger' : '' }}"
                               name="control_coupons" value="{{ old('control_coupons', $pollingStation->control_coupons) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('control_coupons'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('control_coupons'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('control_coupons') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Trim confirmations:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('trim_confirmations') ? ' is-danger' : '' }}"
                               name="trim_confirmations" value="{{ old('trim_confirmations', $pollingStation->trim_confirmations) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('trim_confirmations'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('trim_confirmations'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('trim_confirmations') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Valid:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('valid') ? ' is-danger' : '' }}"
                               name="valid" value="{{ old('valid', $pollingStation->valid) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('valid'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('valid'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('valid') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field m-b-50">
                    <label class="label"><small>Invalid:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('invalid') ? ' is-danger' : '' }}"
                               name="invalid" value="{{ old('invalid', $pollingStation->invalid) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('invalid'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('invalid'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('invalid') }}</strong>
                        </p>
                    @endif
                </div>

                @foreach($pollingStation->electoralLists as $electoralList)
                    <div class="field">
                        <label class="label"><small>{{ $electoralList->number }}. {{ $electoralList->name }}:</small></label>
                        <div class="control has-icons-right">
                            <input type="text" class="input{{ $errors->has('list' . $loop->index) ? ' is-danger' : '' }}"
                                   name="list[{{$electoralList->id}}]" value="{{ old('list.'. $electoralList->id, $electoralList->pivot->votes) }}"
                                   placeholder="" required autofocus>
                            @if ($errors->has('list' . $loop->index))
                                <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                            @endif
                        </div>
                        @if ($errors->has('list' . $loop->index))
                            <p class="help is-danger">
                                <strong>{{ $errors->first('list' . $loop->index) }}</strong>
                            </p>
                        @endif
                    </div>
                @endforeach

                <div class="field m-t-50">
                    <label class="label"><small>Registered ({{ $pollingStation->registered_check }}):</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('registered') ? ' is-danger' : '' }}"
                               name="registered" value="{{ old('registered', $pollingStation->registered) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('registered'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('registered'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('registered') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Voted at the polling station:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('voted_at_the_polling_station') ? ' is-danger' : '' }}"
                               name="voted_at_the_polling_station" value="{{ old('voted_at_the_polling_station', $pollingStation->voted_at_the_polling_station) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('voted_at_the_polling_station'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('voted_at_the_polling_station'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('voted_at_the_polling_station') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Voted out of the polling station:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('voted_out_of_the_polling_station') ? ' is-danger' : '' }}"
                               name="voted_out_of_the_polling_station" value="{{ old('voted_out_of_the_polling_station', $pollingStation->voted_out_of_the_polling_station) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('voted_out_of_the_polling_station'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('voted_out_of_the_polling_station'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('voted_out_of_the_polling_station') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>In total:</small></label>
                    <div class="control has-icons-right">
                        <input type="text" class="input{{ $errors->has('in_total') ? ' is-danger' : '' }}"
                               name="in_total" value="{{ old('in_total', $pollingStation->in_total) }}"
                               placeholder="" required autofocus>
                        @if ($errors->has('in_total'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('in_total'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('in_total') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <div class="control m-t-30 m-b-40">
                        <label class="checkbox">
                            <input type="checkbox" name="valid_save" value="1">
                            Skip validation and save inconsistent results with SEC or MEC confirmation
                        </label>
                    </div>
                </div>

                <input type="hidden" name="registered_check" :value="{{ $pollingStation->registered_check }}">

                <div class="field m-t-30">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span>Update Polling Station</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const ModalForm = {
            props: {
                user: {
                    type: Number,
                    default: {!! $userId !!}
                },
                users: {
                    type: Array,
                    default: function () {
                        return {!! $users !!}
                    }
                }
            },
            data() {
                    return {
                        userSearch: this.users,
                        searchTxt: '',
                        isLoading: false
                    }
            },
            watch: {
                searchTxt: _.debounce(function () {
                    let thisModal = this
                    this.userSearch = []
                    this.isLoading = true
                    this.users.find(function(element) {
                        if(element.name.toLowerCase().search(thisModal.searchTxt.toLowerCase()) > -1) {
                            thisModal.userSearch.push(element)
                        }
                    })
                    this.isLoading = false
                }, 1000)
            },
            template: `
                <form action="{{route('polling-stations.add-user', $pollingStation->id)}}" method="post" @keydown.enter.prevent>
                    @method('PUT')
                    @csrf
                    <div class="modal-card" style="width: auto">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Add a User</p>
                        </header>
                        <section class="modal-card-body">
                            <b-field>
                                <b-input placeholder="Search..."
                                    type="search"
                                    icon-pack="fa"
                                    icon="search"
                                    v-bind:loading="isLoading"
                                    v-model="searchTxt">
                                </b-input>
                            </b-field>
                            <div v-for="userInfo in userSearch">
                                <b-field>
                                    <b-radio name="user" v-bind:native-value="userInfo.id" v-bind:value="user">@{{ userInfo.name }}</b-radio>
                                </b-field>
                            </div>
                        </section>
                        <footer class="modal-card-foot">
                            <button class="button" type="button" @click="$parent.close()">Close</button>
                            <button class="button is-primary">Save</button>
                        </footer>
                    </div>
                </form>
            `
            }


        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                cardModal() {
                    this.$modal.open({
                        parent: this,
                        component: ModalForm,
                        hasModalCard: true
                    })
                }
            }
        })
    </script>
@endsection