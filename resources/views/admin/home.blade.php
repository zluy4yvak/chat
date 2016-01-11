@extends('admin.admin')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Page!</div>
                <div class="panel-body">
                    <a href="admin/add">Create new user</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User List</div>
                {!! csrf_field() !!}
                <div class="panel-body">
                    @foreach ($users as $user)
                    <div class="block">
                        <a href="admin/user/{{ $user->id }}" class="row">{{ $user->name }} </a>
                        <div>{{ $user->email }}</div>                
                            <button data-id = "{{ $user->id }}" class="del-user">Удалить</button>
                        <hr>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
