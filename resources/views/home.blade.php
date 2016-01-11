@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="message">New mail</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Mail inbox</div>

                <div class="panel-body">
                    <a href="dialog">Mails  <div id='count'>{{ $count ? '('.$count.')' : '' }}</div></a> 
                    <button id='refresh'><i class="fa fa-btn fa-refresh"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
