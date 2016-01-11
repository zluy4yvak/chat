@extends('admin.admin')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User {{ $user->name }}</div>
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
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/save', $user->id) }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Lock</label>

                            <div class="col-md-6">
                                <input type="checkbox" class="form-checkbox" name="lock" {{ $user->lock ? 'checked' : '' }} value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Regenerate password</label>

                            <div class="col-md-6">
                                <input type="checkbox" class="form-checkbox" name="regenerate" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-save"></i>Save
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="/admin" class="btn btn-primary">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection