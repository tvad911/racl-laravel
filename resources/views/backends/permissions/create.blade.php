@extends('backends.backend')
@section('header')
    <title>AdminLTE 2 | User Profile</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            {{ trans('backend.permission') }}
        </h1>
        {!! Backend::breadscrumb('backend.home','backend.permission') !!}
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
                        <h3 class="box-title"><i class="fa fa-plus-square" aria-hidden="true"></i> {{ trans('backend.create', ['name' => trans('backend.permission') ]) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('flash::message')
                    <!-- form start -->
                    {!! Form::open(array('route' => 'admin.permission.store','role' => 'form')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('area', trans('permission.area')) !!}
                            {!! Form::text('area', old('area'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('permission.area')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('permission', trans('permission.permission')) !!}
                            {!! Form::text('permission', old('permission'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('permission.permission')]))) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('actions', trans('permission.actions')) !!}
                            {!! Form::text('actions', old('actions'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('permission.actions')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('description', trans('permission.description')) !!}
                            {!! Form::textarea('description', old('description'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('permission.description')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {!! Form::submit(trans('messages.create', ['name' => trans('backend.permission') ]), array('class' => 'btn btn-primary')) !!}
                        <a class="btn btn-primary" href="{{ route('admin.permission.index') }}">
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