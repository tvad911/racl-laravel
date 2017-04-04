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
            <div class="col-md-3">
                <!-- general form elements -->
                <div class="box box-primary box-link-menus" data-type="custom-link">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="icon-layers font-dark"></i>
                            Custom link
                        </h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label"><b>Title</b></label>
                            <input type="text" class="form-control" placeholder="" value="" name="" data-field="title" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Url</b></label>
                            <input type="text" class="form-control" placeholder="" value="" name="" data-field="url" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Css class</b></label>
                            <input type="text" class="form-control" placeholder="" value="" name="" data-field="css_class" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Icon font class</b></label>
                            <input type="text" class="form-control" placeholder="" value="" name="" data-field="icon_font" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><b>Target type</b></label>
                            <select name="" class="form-control" data-field="target">
                                <option value="">Not set</option>
                                <option value="_self">Self</option>
                                <option value="_blank">Blank</option>
                                <option value="_parent">Parent</option>
                                <option value="_top">Top</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <button class="btn btn-primary add-item" type="submit">
                            <i class="fa fa-plus"></i> Add
                        </button>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-9">
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
    <script>
      $(function () {
        $('input[type=checkbox]').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
@endsection