@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Elections</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('elections.update', $election->id)}}" method="post">
                @method('PUT')
                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-right">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ $election->name }}" placeholder="Elections Name" required autofocus>
                        @if ($errors->has('name'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('name'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Status:</small></label>
                    <div class="control has-icons-left">
                        <div class="select">
                            <select name="status" required autofocus>
                                <option value="0" @if($election->status == 0) selected @endif>Setup</option>
                                <option value="1" @if($election->status == 1) selected @endif>In progress</option>
                                <option value="2" @if($election->status == 2) selected @endif>Finished</option>
                            </select>
                        </div>
                        <span class="icon is-left">
                            <i class="fa fa-globe"></i>
                          </span>
                    </div>
                    @if ($errors->has('status'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('status') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Election Types:</small></label>
                    <div class="control has-icons-left">
                        <div class="select">
                            <select name="electionType" required autofocus>
                                @foreach($electionTypes as $electionType)
                                    <option value="{{ $electionType->id }}"
                                    @if($electionType->id == $election->election_type_id) selected @endif
                                    >{{ $electionType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="icon is-left">
                            <i class="fa fa-globe"></i>
                          </span>
                    </div>
                    @if ($errors->has('electionType'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('electionType') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Municipalities:</small></label>
                    <ul class="municipality-col">
                        @foreach($municipalities as $municipality)
                            <li><b-checkbox class="m-r-10" native-value="{{ $municipality->name }}" v-model="municipalities">{{ $municipality->name }}</b-checkbox></li>
                        @endforeach
                    </ul>
                </div>

                <input type="hidden" name="municipalities" :value="municipalities">

                <div class="field">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span>Edit Elections</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                municipalities: {!!$election->municipalities->pluck('name')!!}
            }
        })
    </script>
@endsection