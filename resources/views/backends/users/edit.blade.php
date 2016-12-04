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
                        <h3 class="box-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ trans('backend.show', ['name' => trans('backend.user') ]) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('flash::message')
                    <!-- form start -->
                    {!! Form::open(array('route' => array('admin.user.update', $item->id),'method' => 'put','role' => 'form')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('email', trans('user.email')) !!}
                            {!! Form::email('email', old('email', $item->email), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('user.email')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name', trans('user.username')) !!}
                            {!! Form::text('username', old('username', $item->username), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('user.username')]), 'autocomplete' => 'false' )) !!}
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
                            {!! Form::text('name', old('name', $item->name), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('user.fullname')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('group', trans('user.group')) !!}
                            <select name="group_id" id="group_id" class="form-control">
                                <option value=""></option>
                                @foreach($groups as $group)
                                    @if(old('group_id'))
                                        <option value="{{ $group->id }}" {!! (old('group_id') == $group->id) ? 'selected="selected"' : '' !!}>{{ $group->name }}</option>
                                    @else
                                        <option value="{{ $group->id }}" {!! ($item->group_id == $group->id) ? 'selected="selected"' : '' !!}>{{ $group->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                     <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('status', trans('messages.status')) !!}
                            {!! Form::select('status', array('1' => trans('messages.active'), '0' => trans('messages.unactive')), old('status', $item->status), array('class' => 'form-control input-sm')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
					{!! Form::hidden('id',$item->id) !!}
                    <div class="box-footer">
                        {!! Form::submit(trans('messages.update'), array('class' => 'btn btn-primary')) !!}
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