@extends('adminlte::page')
@section('content_header')
    <h1>Статистика</h1>
@stop

@section('content')
    <div>
        <div class="box">
            <div class="box-header"><h2>Общая статистика</h2></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3 style="font-size: 24px">{{$all}} UAH</h3>
                                <p>За все время</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 style="font-size: 24px">   {{$todayPayments}} UAH</h3>
                                <p>Сегодня</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 style="font-size: 24px">{{$currentMonth}} UAH</h3>
                                <p> Текущий месяц</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3 style="font-size: 24px">{{$previousMonth}} UAH</h3>
                                <p> Предыдущий месяц</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>


    <div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="box-header"><h2>TOP 10 мерчантов</h2></div>

        <div class="col-lg-3 col-xs-12">

            <table class="table small-box bg-aqua ">
                <caption> За все время</caption>
                @foreach($top10 as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{$merchant->summa}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-lg-3 col-xs-12">

            <table class="table small-box bg-yellow">
                <caption class="caption"> Сегодня</caption>
                @foreach($top10Today as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{$merchant->summa}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-lg-3 col-xs-12">

            <table class="table small-box bg-green">
                <caption> Текущий месяц</caption>
                @foreach($top10currentMonth as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{$merchant->summa}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-lg-3 col-xs-12" >

            <table class="table small-box bg-red">
                <caption> Предыдущий месяц</caption>
                @foreach($top10previousMonth as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{$merchant->summa}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>   </div>   </div>
@stop