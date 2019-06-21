@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Редактирование MCC кода</h1>
@stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Редактирование MCC кода</h3>
                    <div class="box-body" id="mcc-codes">
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
                        {!! Form::open(array('url' => route('mcc.update',['id'=>$code->id]),'method' => 'Patch','id'=>'mcc_update')) !!}
                        <div>
                            {{ Form::label('mcc_name',"Наименование кода" ) }}
                            {{ Form::text("mcc_name",  $code->name,['class'=>'form-control','id'=>'merchant_identifier']) }}
                        </div>

                        <div>
                            {{ Form::label('mcc_code',"Код" ) }}
                            {{ Form::text("mcc_code",  $code->code,['class'=>'form-control']) }}
                        </div>

                        <div>
                            {{ Form::label('mcc_apple_pay',"Apple Pay status" ) }}
                            {{ Form::select("mcc_apple_pay",  ['1' => 'Активен', '0' => 'Не активен'], $code->apple_pay ,['class'=>'form-control']) }}
                        </div>


                        <div style="margin-top: 15px">
                            {{Form::submit('Изменить код',['class'=>'form-control btn btn-primary','id'=>'submit_btn'])}}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop