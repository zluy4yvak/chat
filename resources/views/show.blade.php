@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Message from {{ $sender->name }}</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{!! $error !!}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (Session::has('flash_messages'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert"></button>
                        {{ Session::get('flash_messages') }}
                    </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/answer',$id) }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="sender_id" value="{{ $sender->id }}">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Message</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="message" rows="5" id="comment"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-save"></i>Answer
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/dialog" class="btn btn-primary">
                                    Back
                                </a>
                            </div>                        
                        </div>   
                        <hr>
                        <div class="form-group" style="padding-left:300px;">
                            <div class="col-md-6"> 
                                <span class="col-md-4 control-label" style="text-align:left;">HISTORY</span>
                            </div>
                        </div>
                        <hr>
                        @foreach ($messages as $message)
                        <div class="form-group" style="padding-left:300px;">
                            <div class="col-md-6"> 
                                <span class="col-md-5 control-label" style="text-align:left;width:100%; {{!$message->read ? 'background-color: rgba(49, 112, 143, 0.27);' : '' }}"><small>{{ $message->getSenderName->name }}</small> | <small>{{ $message->created_at }}</small> | {{ $message->message }}</span>
                            </div>
                        </div>
                        @endforeach
                    </form>                   
                </div>
                <hr>
            </div>          
        </div>        
    </div>
</div>
@endsection