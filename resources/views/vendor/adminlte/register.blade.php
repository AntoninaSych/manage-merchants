{{--@extends('adminlte::page')--}}


{{--@section('content_header')--}}
{{--    <h1>Регистрация нового пользователя</h1>--}}
{{--@stop--}}

{{--@section('content')--}}

<div class="modal fade in" id="modal-add-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Добавление пользователя</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">


{{--    @if (\Session::has('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            <ul>--}}
{{--                <li>{!! \Session::get('success') !!}</li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

            <div class="alert alert-error"  id='error-user-add'  style="display: none">
                <ul>
                    <li>{!! \Session::get('errors') !!}</li>
                </ul>
            </div>

    <div class="row">
    <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <p class="login-box-msg">Введите данные для регистрации нового пользователя:</p>
                    <form action="{{ url(config('adminlte.register_url', 'register')) }}" id="register-user" method="post">
                        {!! csrf_field() !!}

                        <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                            <input type="text" name="name" class="form-control"   value="{{ old('name') }}"
                                   placeholder="Введите имя пользователя">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            @if ($errors->has('name'))
                                <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input type="email" name="email"  maxlenght="15" class="form-control" value="{{ old('email') }}"
                                   placeholder="Введите Email"  max="25">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @if ($errors->has('email'))
                                <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback">
                            <select name="role" class="form-control" required>
                                <option value="" selected disabled hidden>Выберите роль</option>
                                @foreach($roles as $role)
                                    <option value="{{$role['name']}}">{{$role['display_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}"
                             style="display:none">
                            <input type="password" name="password" class="form-control" value="password"
                                   placeholder="{{ trans('adminlte::adminlte.password') }}">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @if ($errors->has('password'))
                                <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}"
                             style="display:none">
                            <input type="password" name="password_confirmation" class="form-control" value="password"
                                   placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                            @endif
                        </div>
                        <button type="submit" id="register_new_user"
                                class="btn btn-primary btn-block btn-flat"
                        >Зарегистрировать</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
            </div>
        </div>
    </div>
</div>

{{--@stop--}}

