@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit New Polling Station</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('polling-stations.update', $pollingStation->id)}}" method="post">
                @method('PUT')
                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-right">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ $pollingStation->name }}" placeholder="Polling Station Name" required autofocus>
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
                    <label class="label"><small>Municipality:</small></label>
                    <div class="control has-icons-left">
                        <div class="select">
                            <select name="municipality" required autofocus>
                                @foreach($municipalities as $municipality)
                                    <option value="{{ $municipality->id }}"
                                    @if($municipality->id == $pollingStation->default_municipality_id) selected @endif
                                    >{{ $municipality->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="icon is-left">
                            <i class="fa fa-globe"></i>
                          </span>
                    </div>
                    @if ($errors->has('municipality'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('municipality') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Registered:</small></label>
                    <div class="control">
                        <input id="registered" type="text" class="input" name="registered" value="{{ $pollingStation->registered }}" placeholder="e.g 425" required autofocus>
                    </div>
                    @if ($errors->has('registered'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('registered') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span>Create Polling Station</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
