@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @foreach ($users->getDialog as $user)
                <a href="show/{{ $user->getMessages->dialog_id }}">
                    <div class="panel-heading" style="background-color:rgba(135, 137, 140, 0.35);">{{ getDialogName($user->getMessages->dialog_id) }} {{ $user->getMessages->getNotReadMessagesById($user->getMessages->dialog_id) }} </div>
                    <div class="panel-body">
                        <h5>{{ $user->getMessages->created_at }}</h5>
                        <h4>{{ $user->getMessages->message }}</h4>
                    </div>
                </a>
                <hr>
                @endforeach
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <a href="/home" class="btn btn-primary">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection