@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Create New Elections</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('elections.store')}}" method="post">

                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control">
                        <input id="name" type="text" class="input" name="name" value="{{ old('number') }}" placeholder="e.g Parliamentary Elections 2018." required autofocus>
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
                                <option value="0" selected>Setup</option>
                                <option value="1">In progress</option>
                                <option value="2">Finished</option>
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
                                    <option value="{{ $electionType->id }}">{{ $electionType->name }}</option>
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
                            <li><b-checkbox class="m-r-10" native-value="{{ $municipality->id }}:{{ $municipality->name }}" v-model="municipalities">{{ $municipality->name }}</b-checkbox></li>
                        @endforeach
                    </ul>
                </div>
                <div class="field">
                <input type="hidden" name="municipalities" :value="municipalities">
                @if ($errors->has('municipalities'))
                    <p class="help is-danger">
                        <strong>{{ $errors->first('municipalities') }}</strong>
                    </p>
                @endif
                </div>
                <div class="field m-t-30">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span>Create Elections</span>
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
                municipalities: []
            }
        })
    </script>
@endsection