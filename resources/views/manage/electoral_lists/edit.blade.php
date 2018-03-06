@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Electoral List</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('electoral-lists.update', $electoralList->id)}}" method="post">
                @method('PUT')
                @csrf

                <div class="field">
                    <label class="label"><small>Number:</small></label>
                    <div class="control">
                        <input id="number" type="text" class="input" name="number" value="{{ $electoralList->number }}" placeholder="e.g 1" required autofocus>
                    </div>
                    @if ($errors->has('number'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('number') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-right">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ $electoralList->name }}" placeholder="Electoral List Name" required autofocus>
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
                    <label class="label"><small>Elections:</small></label>
                    <div class="control has-icons-left">
                        <div class="select">
                            <select name="election" required autofocus>
                                @foreach($elections as $election)
                                    <option value="{{ $election->id }}"
                                    @if($election->id == $electoralList->election_id) selected @endif
                                    >{{ $election->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="icon is-left">
                            <i class="fa fa-globe"></i>
                          </span>
                    </div>
                    @if ($errors->has('election'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('election') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span>Edit Electoral List</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
