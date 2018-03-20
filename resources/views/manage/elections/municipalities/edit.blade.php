@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Municipality {{ $municipality->name }}</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('municipalities.update', $municipality->id)}}" method="post">
                @method('PUT')
                @csrf

                <label class="label"><small>Assign a User:</small></label>
                <div class="field users-col">
                    @foreach($users as $user)
                        <div class="field">
                            <b-radio name="user" native-value="{{ $user->id }}" v-model="user">{{ $user->name }}</b-radio>
                        </div>
                    @endforeach
                </div>

                <div class="field m-t-30">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span>Update Municipality</span>
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
                user: {!! $userId !!}
            }

        })
    </script>
@endsection