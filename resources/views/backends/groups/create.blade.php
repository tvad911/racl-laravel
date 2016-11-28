@extends('backends.backend')
@section('header')
    <title>AdminLTE 2 | User Profile</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            {{ trans('backend.group') }}
        </h1>
        {!! Backend::breadscrumb('backend.home','backend.group') !!}
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
                        <h3 class="box-title"><i class="fa fa-plus-square" aria-hidden="true"></i> {{ trans('backend.create', ['name' => trans('backend.group') ]) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('flash::message')
                    <!-- form start -->
                    {!! Form::open(array('route' => 'admin.group.store','role' => 'form')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name', trans('group.name')) !!}
                            {!! Form::text('name', old('name'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('group.name')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        {!! Form::label('permission', trans('permission.permission')) !!}
                        @if(isset($permissions) && $permissions != null)
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ $permission->area . '.' . $permission->permission }}
                                                {!! Backend::getActionsAttributeCheckbox($permission, old('permission')) !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div><!-- /.row -->
                            </div>
                        @else
                            Chưa có quyền nào được tạo, vui lòng tạo quyền trước khi chọn ở đây
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {!! Form::submit(trans('messages.create', ['name' => trans('backend.group') ]), array('class' => 'btn btn-primary')) !!}
                        <a class="btn btn-primary" href="{{ route('admin.group.index') }}">
                            {{ trans('messages.cancel') }}
                        </a>
                    </div>
                    <!-- /.box-footer -->
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
@section('script')
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@endsection