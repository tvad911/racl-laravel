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
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-plus-square" aria-hidden="true"></i> {{ trans('backend.create', ['name' => trans('backend.menu') ]) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    @include('flash::message')
                    <!-- form start -->
                    {!! Form::open(array('route' => 'admin.menu.store','role' => 'form')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('title', trans('menu::menu.title')) !!}
                            {!! Form::email('title', old('title'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('menu::menu.title')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('slug', trans('menu::menu.slug')) !!}
                            {!! Form::text('slug', old('slug'), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('menu::menu.slug')]), ' autocomplete' => 'false')) !!}
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
                        {!! Form::submit(trans('messages.create', ['name' => trans('backend.menu') ]), array('class' => 'btn btn-primary')) !!}
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
        </div>
        <!-- /.row -->
    </section><!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $('form input[name=title]').on('blur', function(){
                var slug;

                slug = getSlug($(this).val());
                $('form input[name=title]').val(slug);
            });
        });
    </script>
@endsection