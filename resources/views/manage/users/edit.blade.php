@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit User</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('users.update', $user->id)}}" method="post">
                @method('PUT')
                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-left has-icons-right">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ $user->name }}" placeholder="Name input" required autofocus>
                        <span class="icon is-small is-left">
                            <i class="fa fa-user"></i>
                        </span>
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
                    <label class="label"><small>Email:</small></label>
                    <div class="control has-icons-left has-icons-right">
                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ $user->email }}" placeholder="Email input" required autofocus>
                        <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                        </span>
                        @if ($errors->has('email'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Password:</small></label>
                    <div class="field">
                        <b-radio name="passwordOptions" native-value="keep" v-model="passwordOptions">Do Not Change Password</b-radio>
                    </div>
                    <div class="field">
                        <b-radio name="passwordOptions" native-value="auto" v-model="passwordOptions">Auto-Generate Password</b-radio>
                    </div>
                    <div class="field">
                        <b-radio name="passwordOptions" native-value="manual" v-model="passwordOptions">Manually Set New Password</b-radio>
                    </div>
                </div>

                <div class="field" v-if="passwordOptions == 'manual'">
                    <p class="control has-icons-left">
                        <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" placeholder="Password" required>
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                    </p>
                    @if ($errors->has('password'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </p>
                    @endif
                </div>

                <h1 class="subtitle m-t-20 m-b-10">Roles:</h1>
                <ul class="m-b-30">
                    @foreach($roles as $role)
                        <li class="m-b-10">
                            <b-checkbox class="m-r-10" native-value="{{ $role->id }}" v-model="roles">{{ $role->display_name }} <em class="m-l-15"><small>{{ $role->description }}</small></em></b-checkbox>
                        </li>
                    @endforeach
                </ul>
                <input type="hidden" name="roles" :value="roles">

                <div class="field m-t-30">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>
                            <span>Edit User</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const app = new Vue({
            el: "#app",
            data: {
                passwordOptions: 'keep',
                roles: {!! $user->roles->pluck('id') !!}
            }
        })
    </script>
@endsection