@extends('backends.backend')
@section('header')
    <title>AdminLTE 2 | User Profile</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('public/vendor/menu/dist/vendor/jquery-nestable/jquery.nestable.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendor/menu/dist/css/menu.css') }}">
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
                @if(isset($item) && $item->id)
                <!-- <div class="box box-primary box-link-menus" data-type="custom-link">
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
                </div> -->
                <div class="box box-primary box-link-menus" data-type="custom-link">
                    <div class="widget panel">
                        <div class="widget-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseCustomLink" class="" aria-expanded="true">
                                <h4 class="widget-title">
                                    <i class="box_img_sale"></i>
                                    <span>Add link</span>
                                    <i class="fa narrow-icon fa-angle-up"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseCustomLink" class="panel-collapse collapse in" aria-expanded="true">
                            <div class="widget-body">
                                <div class="box-links-for-menu">
                                    <div id="external_link" class="the-box">
                                        <div class="node-content">
                                            <div class="form-group">
                                                <label for="node-title">Title</label>
                                                <input type="text" required="required" class="form-control" id="node-title" autocomplete="false">
                                            </div>
                                            <div class="form-group">
                                                <label for="node-url">URL</label>
                                                <input type="text" required="required" class="form-control" id="node-url" placeholder="http://" autocomplete="false">
                                            </div>
                                            <div class="form-group">
                                                <label for="node-icon">Icon</label>
                                                <input type="text" required="required" class="form-control" id="node-icon" placeholder="fa fa-home" autocomplete="false">
                                            </div>
                                            <div class="form-group">
                                                <label for="node-css">CSS class</label>
                                                <input type="text" required="required" class="form-control" id="node-css" autocomplete="false">
                                            </div>
                                            <div class="form-group">
                                                <label for="target">Target</label>
                                                <select name="target" class="form-control select-full select2-hidden-accessible" id="target" tabindex="-1" aria-hidden="true">
                                                    <option value="_self">Open link directly</option>
                                                    <option value="_blank">Open link in new tab</option>
                                                </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-target-container"><span class="select2-selection__rendered" id="select2-target-container" title="Open link directly">Open link directly</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                            </div>

                                            <div class="text-right form-group node-actions hide">
                                                <a class="btn red btn-remove" href="#">Remove</a>
                                                <a class="btn blue btn-cancel" href="#">Cancel</a>
                                            </div>

                                            <div class="form-group">
                                                <div class="text-right add-button">
                                                    <div class="btn-group">
                                                        <a href="#" class="btn-add-to-menu btn btn-primary"><span class="text"><i class="fa fa-plus"></i> Add to menu</span></a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
                @endif
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
                    {!! Form::open(array('route' => array('admin.menu.update', $item->id),'method' => 'put','role' => 'form')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('title', trans('menu::menu.title')) !!}
                            {!! Form::text('title', old('title', $item->title), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('menu::menu.title')]) )) !!}
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('slug', trans('menu::menu.slug')) !!}
                            {!! Form::text('slug', old('slug', $item->slug), array('class' => 'form-control', 'placeholder' => trans('messages.please', ['name' => trans('menu::user.slug')]), 'autocomplete' => 'false')) !!}
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

                    <!-- /.box-body -->
                     <div class="box-body">
                        <div class="form-group">
                            <div class="widget">
                                <div class="widget-title">
                                    <h4>
                                        <i class="fa fa-bars font-dark"></i>
                                        <span>Menu structure</span>
                                    </h4>
                                </div>
                                <div class="widget-body">
                                    <div class="dd nestable-menu" id="nestable" data-depth="0">
                                        {!! $nestables or '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {!! Form::hidden('id',$item->id) !!}

                    <div class="box-footer">
                        {!! Form::submit(trans('messages.update'), array('class' => 'btn btn-primary')) !!}
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
    <script type="text/javascript" src="{{ asset('public/vendor/menu/dist/vendor/jquery-nestable/jquery.nestable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/vendor/menu/dist/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/vendor/menu/dist/js/menu.js') }}"></script>
    <script type="text/javascript">
        $(window).load(function() {
            MenuNestable.init();
            MenuNestable.handleNestableMenu();
        });
    </script>
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