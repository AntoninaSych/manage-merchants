@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1></h1>
@stop
<style>

    .wrap {
        position: relative;
        /*width: 33.33%;*/
        /*margin: -72px 0;*/
        /*top: 50%;*/
        /*float: left;*/
    }

    input[type="checkbox"] + label {
        margin: 1.5em auto;
    }

    input[type="checkbox"] {
        display: none;
        /*position: absolute;*/
        /*left: -9999px;*/
    }

    .slider-v2::after {
        position: absolute;
        content: '';
        width: 2em;
        height: 2em;
        top: 0.5em;
        left: 0.5em;
        border-radius: 50%;
        transition: 250ms ease-in-out;
        background: linear-gradient(#f5f5f5 10%, #eeeeee);
        box-shadow: 0 0.1em 0.15em -0.05em rgba(255, 255, 255, 0.9) inset, 0 0.2em 0.2em -0.12em rgba(0, 0, 0, 0.5);
    }

    .slider-v2::before {
        position: absolute;
        content: '';
        width: 4em;
        height: 1.5em;
        top: 0.75em;
        left: 0.75em;
        border-radius: 0.75em;
        transition: 250ms ease-in-out;
        background: linear-gradient(rgba(0, 0, 0, 0.07), rgba(255, 255, 255, 0.1)), #d0d0d0;
        box-shadow: 0 0.08em 0.15em -0.1em rgba(0, 0, 0, 0.5) inset, 0 0.05em 0.08em -0.01em rgba(255, 255, 255, 0.7), 0 0 0 0 rgba(68, 204, 102, 0.7) inset;
    }

    input:checked + .slider-v2::before {
        box-shadow: 0 0.08em 0.15em -0.1em rgba(0, 0, 0, 0.5) inset, 0 0.05em 0.08em -0.01em rgba(255, 255, 255, 0.7), 3em 0 0 0 rgba(68, 204, 102, 0.7) inset;
    }

    input:checked + .slider-v2::after {
        left: 3em;
    }


</style>
@section('content')
    <div class="content">
        <a href="/snippets">Перейти к списку шаблонов</a>
        <button data-target="#modal-add-payment-route-snippet" data-toggle="modal" class="btn btn-primary"><i
                    class="fa fa-fw fa-plus"></i>Добавить роут в шаблон
        </button>
        <div class="row">

            <div class="col-xs-12" id="snippet-list">
@include('merchants.snippets.routes.snippet-route-list')
            </div>
        </div>
    </div>
    @if(Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_ROUTE))
        @include('merchants.snippets.routes.modal-add-payment-route-snippet')
        @include('merchants.snippets.routes.modal-remove-payment-route-snippet')
        @include('merchants.snippets.routes.modal-edit-payment-route-snippet')
    @endif
@stop

<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
<link href="{{asset('/css/jquery-11.css')}}" rel="stylesheet">
<script>
    var snippet_id = {!!  $snippetId !!};

</script>
<script src="{{ asset('js/snippets.js') }}"></script>

