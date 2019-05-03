@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Информация о мерчантe</h1>
@stop


@section('content')
    <?php
    $relations = $merchant->getRelations();
    ?>

    <div class="nav-tabs-custom" style="cursor: move;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
            <li class="active"><a href="#main-information" data-toggle="tab" aria-expanded="false">Детали</a></li>

            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) )
                <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Настройки</a></li>
            @endif

            <li class=""><a href="#refound" data-toggle="tab" aria-expanded="false">Возмещение</a></li>


            <li class="pull-left header"><i class="fa fa-inbox"></i> Информация о мерчантe</li>
        </ul>
        <div class="tab-content no-padding">
            {{--               Merchant's details begin--}}
            <div id="main-information" class="tab-pane ">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$merchant->name}}</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="label label-primary">{{$merchant->name}}</span>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <td>Идентификатор мерчанта</td>
                                <td>{{$merchant->merchant_id}}</td>
                            </tr>
                            <tr>
                                <td>Имя</td>
                                <td>{{$merchant->name}}</td>
                            </tr>
                            <tr>
                                <td>URL</td>
                                <td><a href="{{$merchant->url}}">{{$merchant->url}}</a></td>
                            </tr>
                            <tr>
                                <td>Статус</td>
                                <td>{{$relations['status']->name}}</td>
                            </tr>
                            <tr>
                                <td>Имя мерчанта</td>
                                <td>
                                    {{$relations['user']->username}}<br>

                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    {{$relations['user']->email}}
                                </td>
                            </tr>
                            <tr>
                                <td>Дата обновления</td>
                                <td>{{$merchant->updated}}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- box-footer -->
                </div>
            </div>
            {{--               Merchant's detailsvend--}}



            {{--               Settings detailsvend--}}
            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) )
                <div id="settings" class="tab-pane active">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$merchant->name}}</h3>
                            <div class="box-tools pull-right">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <span class="label label-primary">{{$merchant->name}}</span>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body cols-md-6">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! \Session::get('success') !!}</li>
                                        </ul>
                                    </div>
                                @endif

                            {!! Form::open(array('url' => route('merchant.update',['id'=>$merchant->id]),'method' => 'POST')) !!}

                            {{ Form::label('merchant_identifier',"Идентификатор мерчанта" ) }}
                            {{ Form::text("merchant_identifier",  $merchant->merchant_id,['class'=>'form-control']) }}

                            {{ Form::label('merchant_name',"Имя" ) }}
                            {{ Form::text("merchant_name",  $merchant->name,['class'=>'form-control']) }}

                            {{ Form::label("URL", null ) }}
                            {{ Form::text("merchant_url",  $merchant->url,['class'=>'form-control']) }}

                            {{ Form::label("merchant_status","Статус"  ) }}

                            {{ Form::select("merchant_status", $arrayMerchantStatuses->toArray(), $relations['status']->id ,
                            ['class'=>'form-control']) }}

                            {{ Form::label("Имя мерчанта", null ) }}
                            {{ Form::text("merchant_user_name",  $relations['user']->username,['class'=>'form-control']) }}

                            {{ Form::label("Email мерчанта", null ) }}
                            {{ Form::text("merchant_user_email",  $relations['user']->email,['class'=>'form-control']) }}
                            {{ Form::label(" ", null, ['class' => 'control-label']) }}

                            {{Form::submit('Обновить данные мерчанта',['class'=>'form-control btn btn-primary'])}}

                            {!! Form::close() !!}

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                        </div>
                        <!-- box-footer -->
                    </div>
                </div>
            @endif
            {{--Settings detailsvend--}}


            {{--Refound detailsvend--}}
            <div id="refound" class="tab-pane ">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$merchant->name}}</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span class="label label-primary">{{$merchant->name}}</span>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        refound
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- box-footer -->
                </div>
            </div>

            {{--Refound detailsvend--}}

        </div>
    </div>







@stop


