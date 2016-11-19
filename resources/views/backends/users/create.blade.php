@extends('backends.backend')
@section('header')
    <title>AdminLTE 2 | User Profile</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            {{ trans('backend.user') }}
        </h1>
        {!! Backend::breadscrumb('backend.home','backend.user') !!}
    </section>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-plus-square" aria-hidden="true"></i> {{ trans('backend.create', ['name' => trans('backend.user') ]) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('flash::message')
                    <!-- form start -->
                    {!! Form::open(array('route' => 'admin.user.store','role' => 'form')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('email', trans('user.email')) !!}
                            {!! Form::email('email', old('email'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('user.email')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('username', trans('user.username')) !!}
                            {!! Form::text('username', old('username'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('user.username')]), ' autocomplete' => 'false')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('password', trans('user.password')) !!}
                            {!! Form::password('password', array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('user.password')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('password_confirmation', trans('user.repassword')) !!}
                            {!! Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('user.repassword')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name', trans('user.fullname')) !!}
                            {!! Form::text('name', old('name'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('user.fullname')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('status', trans('messages.status')) !!}
                            {!! Form::select('status', array('1' => trans('messages.active'), '0' => trans('messages.unactive')), old('status','0'), array('class' => 'form-control input-sm')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        {!! Form::submit(trans('messages.create', ['name' => trans('backend.user') ]), array('class' => 'btn btn-primary')) !!}
                        <a class="btn btn-primary" href="{{ route('admin.user.index') }}">
                            {{ trans('messages.cancel') }}
                        </a>
                    </div>
                    {!! Form::close() !!}
                    {!! Backend::show_error($errors) !!}
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
@endsection