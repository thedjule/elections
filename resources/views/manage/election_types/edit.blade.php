@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Election Type</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('electionTypes.update', $electionType->id)}}" method="post">
                @method('PUT')
                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-right">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ $electionType->name }}" placeholder="Election Type Name" required autofocus>
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
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span>Edit Election Type</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
