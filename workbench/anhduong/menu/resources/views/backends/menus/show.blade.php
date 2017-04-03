@extends('backends.backend')
@section('header')
    <title>AdminLTE 2 | User Profile</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            {{ trans('backend.menu') }}
        </h1>
        {!! Backend::breadscrumb('backend.home','backend.menu') !!}
    </section>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-2">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ trans('backend.show', ['name' => trans('backend.menu') ]) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('flash::message')
                    <!-- form start -->
                    {!! Form::open(array('route' => array('admin.menu.edit', $item->id),'role' => 'form')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('title', trans('menu::menu.title')) !!}
                            {!! Form::text('title', old('title', $item->title), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('menu::menu.title')]) , 'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('slug', trans('menu::menu.slug')) !!}
                            {!! Form::text('slug', old('slug', $item->slug), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('menu::user.slug')]), 'autocomplete' => 'false', 'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                     <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('status', trans('messages.status')) !!}
                            {!! Form::select('status', array('1' => trans('messages.active'), '0' => trans('messages.unactive')), old('status', $item->status), array('class' => 'form-control input-sm', 'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="box-footer">
                        <a class="btn btn-primary" href="{!! route('admin.menu.edit', $item->id) !!}">
                            {{ trans('messages.edit', ['name' => trans('backend.menu') ]) }}
                        </a>
                        <a class="btn btn-primary" href="{{ route('admin.menu.index') }}">
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
            <div class="col-md-10">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ trans('backend.show', ['name' => trans('backend.menu') ]) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('flash::message')
                    <!-- form start -->
                    {!! Form::open(array('route' => array('admin.menu.edit', $item->id),'role' => 'form')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('title', trans('menu::menu.title')) !!}
                            {!! Form::text('title', old('title', $item->title), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('menu::menu.title')]) , 'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('slug', trans('menu::menu.slug')) !!}
                            {!! Form::text('slug', old('slug', $item->slug), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('menu::user.slug')]), 'autocomplete' => 'false', 'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                     <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('status', trans('messages.status')) !!}
                            {!! Form::select('status', array('1' => trans('messages.active'), '0' => trans('messages.unactive')), old('status', $item->status), array('class' => 'form-control input-sm', 'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="box-footer">
                        <a class="btn btn-primary" href="{!! route('admin.menu.edit', $item->id) !!}">
                            {{ trans('messages.edit', ['name' => trans('backend.menu') ]) }}
                        </a>
                        <a class="btn btn-primary" href="{{ route('admin.menu.index') }}">
                            {{ trans('messages.cancel') }}
                        </a>
                    </div>
                    {!! Form::close() !!}
                    {!! Backend::show_error($errors) !!}
                </div>
                <!-- /.box -->
            </div>
            <!-- End right column -->
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
@endsection