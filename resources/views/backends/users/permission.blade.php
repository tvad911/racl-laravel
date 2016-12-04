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
                        <h3 class="box-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ trans('backend.edit', ['name' => trans('backend.user') ]) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('flash::message')
                    <!-- form start -->
                    {!! Form::open(array('route' => array('admin.user.updatePermission', $item->id),'method' => 'put','role' => 'form')) !!}

                    <div class="box-body">
                        <div class="form-user">
                            {!! Form::label('username', trans('user.username')) !!}
                            {!! Form::text('username', old('username', $item->username), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('user.username')]), 'disabled' => 'disabled')) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        {!! Form::label('role', trans('user.role')) !!}
                        @if(isset($roles) && $roles != null)
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! \Backend::getRoleAttributeCheckboxEdit($role, $edit_roles, old('role')) !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div><!-- /.row -->
                            </div>
                        @else
                            Chưa có role nào trong hệ thống. Vui lòng khởi tạo role trước.
                        @endif
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
                                                {!! Backend::getActionsAttributeCheckboxEdit($permission, $edit_permissions, old('permission')) !!}
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
                    {!! Form::hidden('id',$item->id) !!}

                    <div class="box-footer">
                        {!! Form::submit(trans('messages.update'), array('class' => 'btn btn-primary')) !!}
                        <a class="btn btn-primary" href="{{ route('admin.user.index') }}">
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