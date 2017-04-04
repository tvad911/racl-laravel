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
                @endif
                <!-- general form elements -->
                <div class="box box-primary box-link-menus" data-type="page">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="icon-layers font-dark"></i>
                            Pages
                        </h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 170px;"><div class="scroller height-auto" style="max-height: 300px; overflow: hidden; width: auto; height: 170px;" data-rail-visible="1" data-initialized="1">
                            <ul>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="5" name="">
                            <span></span>
                            <span class="text">Videos</span>
                        </label>

                                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="4" name="">
                            <span></span>
                            <span class="text">Liên hệ</span>
                        </label>

                                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="3" name="">
                            <span></span>
                            <span class="text">Điều khoản</span>
                        </label>

                                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="2" name="">
                            <span></span>
                            <span class="text">Giới thiệu</span>
                        </label>

                                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="1" name="">
                            <span></span>
                            <span class="text">Trang chủ</span>
                        </label>

                                            </li>
                            </ul>
                        </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 170px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                    </div>
                    <div class="box-footer text-right">
                        <button class="btn btn-primary add-item" type="submit">
                            <i class="fa fa-plus"></i> Add
                        </button>
                    </div>
                </div>
                <!-- /.box -->
                <!-- general form elements -->
                <div class="box box-primary box-link-menus" data-type="category">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="icon-layers font-dark"></i>
                            Categories
                        </h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 300px;"><div class="scroller height-auto" style="max-height: 300px; overflow: hidden; width: auto; height: 300px;" data-rail-visible="1" data-initialized="1">
                            <ul>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="2" name="">
                            <span></span>
                            <span class="text">Tư vấn nông nghiệp</span>
                        </label>

                                <ul>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="13" name="">
                            <span></span>
                            <span class="text">Văn bản pháp quy</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="12" name="">
                            <span></span>
                            <span class="text">Trồng trọt</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="11" name="">
                            <span></span>
                            <span class="text">Chăn nuôi</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="1" name="">
                            <span></span>
                            <span class="text">Tin tức nông nghiệp</span>
                        </label>

                                <ul>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="10" name="">
                            <span></span>
                            <span class="text">Sâu bệnh</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="9" name="">
                            <span></span>
                            <span class="text">Sự kiện</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="8" name="">
                            <span></span>
                            <span class="text">Thế giới</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="7" name="">
                            <span></span>
                            <span class="text">Việt Nam</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="3" name="">
                            <span></span>
                            <span class="text">Chuyện nhà nông</span>
                        </label>

                                <ul>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="15" name="">
                            <span></span>
                            <span class="text">Nông thôn mới</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="14" name="">
                            <span></span>
                            <span class="text">Nông dân làm giàu</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="4" name="">
                            <span></span>
                            <span class="text">Vật tư nông nghiệp</span>
                        </label>

                                <ul>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="18" name="">
                            <span></span>
                            <span class="text">Thuốc BVTV</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="17" name="">
                            <span></span>
                            <span class="text">Máy nông nghiệp</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="16" name="">
                            <span></span>
                            <span class="text">Cây giống, con giống</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="5" name="">
                            <span></span>
                            <span class="text">Giá cả thị trường</span>
                        </label>

                                <ul>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="21" name="">
                            <span></span>
                            <span class="text">Nông sản khác</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="20" name="">
                            <span></span>
                            <span class="text">Lúa gạo</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="19" name="">
                            <span></span>
                            <span class="text">Cà phê</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                            </ul>
                            </li>
                                    <li>
                                <label class="mt-checkbox mt-checkbox-outline ">
                            <input type="checkbox" value="6" name="">
                            <span></span>
                            <span class="text">Thời tiết nông vụ</span>
                        </label>

                                <ul>
                            </ul>
                            </li>
                            </ul>
                        </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 126.05px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px; display: none;"></div></div>
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