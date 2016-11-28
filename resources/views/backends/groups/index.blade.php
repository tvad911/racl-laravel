@extends('backends.backend')
@section('header')
    <title>AdminLTE 2 | User Profile</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            {{ trans('backend.group') }}
        </h1>
    </section>
@endsection
@section('content')
    <section class="content">
        <!-- End Header Button -->
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-list" aria-hidden="true"></i> {{ trans('messages.list', ['name' => trans('backend.group')]) }}</h3>

                        <div class="pull-right">
                            <a href="{!! route('admin.group.export', array('type' => 'csv')) !!}"><button id="button-shipping" class="btn btn-info" title="Export to CSV"><i class="fa fa-file-text"></i></button></a>
                            <a href="{!! route('admin.group.export', array('type' => 'pdf')) !!}"><button id="button-invoice" class="btn btn-info" title="Export to Pdf"><i class="fa fa-print"></i></a>
                            </button>
                            <a title="Create User" href="{{ route('admin.group.create') }}"
                               class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    {{-- /.box-header --}}
                    @include('flash::message')
                    <!-- /end .box-body -->
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap" id="example1_wrapper">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{-- {!! Backend::count_items_backend($params, $options) !!} --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="sbox-tools pull-right">
                                        <a data-original-title="Clear Search" href="{!! route('admin.group.index') !!}" class="btn btn-xs btn-white tips" title=""><i class="fa fa-trash-o"></i> Clear Search </a>
                                        {{-- <a data-original-title=" Configuration" href="#" class="btn btn-xs btn-white tips" title=""><i class="fa fa-cog"></i></a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div id="example1_length" class="dataTables_length">
                                        {!! Form::open(array('route' => 'admin.group.index','role' => 'form', 'method'=> 'get')) !!}
                                        {!! Form::label('show','Show') !!}
                                        {!! Form::select('items_per_page', array('1' => '1', '5' => '5', '10' => '10','15' =>
                                        '15','20' => '20','25' => '25', '50' => '50'), $options['items_per_page'],array('class' => 'form-control input-sm'))
                                        !!}
                                        {!! Form::hidden('status', $options['status']) !!}
                                        {!! Form::hidden('sortedBy', $options['sortedBy']) !!}
                                        {!! Form::hidden('orderBy', $options['orderBy']) !!}
                                        {!! Form::submit('Apply',array('class' => 'btn btn-info btn-sm')) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dataTables_filter pull-right" id="example1_filter">
                                        {!! Form::open(array('route' => 'admin.group.index','role' => 'form', 'method'=> 'get')) !!}
                                        <label>
                                            Search:
                                        </label>
                                        <input aria-controls="example1" placeholder="" class="form-control input-sm" type="search" name="search">
                                        {!! Form::select('searchFields', array( 'id;name' => 'Search by All', 'id' => 'Search by ID', 'name' =>
                                        'Search by Name'),
                                        'all',array('class' => 'form-control input-sm', 'aria-controls' => 'example1'))
                                        !!}
                                        <button class="btn btn-sm btn-info" type="submit">Apply</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /end .box-body -->
                    {!! Form::open(array('route' => array('admin.group.updatemulti'), 'method' => 'post')) !!}
                    <!-- .box-body -->
                    <div class="box-body table-responsive no-padding">
                        @if(isset($items) && $items != null)
                            <table class="table table-hover">
                                <?php
                                    $orderBy = (!isset($_GET['orderBy'])) ? 'id' : $_GET['orderBy'];
                                    $sortedBy = (isset($_GET['sortedBy']) && $_GET['sortedBy'] == 'asc') ? 'desc' : 'asc';
                                    $status = (!isset($_GET['status'])) ? 'all' : $_GET['status'];
                                    $items_per_page = (!isset($_GET['items_per_page'])) ? 5 : $_GET['items_per_page'];
                                ?>
                                <tr>
                                    <th><input type="checkbox" name="check-all" id="check-all"></th>
                                    {!! Backend::columns_sortDiff('#ID', 'id', $sortedBy, $options) !!}
                                    {!! Backend::columns_none_sort('Name', 'name', $sortedBy, $options) !!}
                                    {!! Backend::columns_sortDiff('Created at', 'created_at', $sortedBy, $options) !!}
                                    {!! Backend::columns_sortDiff('Updated at', 'updated_at', $sortedBy, $options) !!}
                                    {!! Backend::columns_sortDiff('Created by', 'created_by', $sortedBy, $options) !!}
                                    <th>Action</th>
                                </tr>
                                @foreach ($items as $item)
                                    <tr>
                                        <td><input name="items[]" value="{{ $item->id }}" type="checkbox" id="items[]"/>
                                        </td>
                                        <td><span class="label label-success">{{ $item->id }}</span></td>
                                        <td>{!! Backend::showLink($options, route('admin.group.show', $item->id), $item->name) !!}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>{{ $item->created_by }}</td>
                                        <td>
                                            {!! Backend::showButton($options, route('admin.group.edit', $item->id), $item->id) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {{-- /end table --}}
                        @else
                            Item not found
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div id="example1_length" class="dataTables_length">
                                    <label>
                                        {!! Backend::actionIndexNone($options) !!}
                                    </label>
                                    {!! Form::submit('Apply',array('class' => 'btn btn-info btn-sm')) !!}
                                </div>
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                    {{ $items->links('vendor.pagination.item-on-total') }}
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    {{ $items->links('vendor.pagination.default') }}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                    {!! Form::close() !!}
                </div>
                <!-- /.box -->
                <!-- Action -->
            </div>
        </div>
    </section><!-- /.content -->
    <div class="modal modal-primary" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('messages.delete', ['name' => trans('backend.group') ])}}</h4>
          </div>
          <div class="modal-body">
            <p>{{ trans('messages.delete_destroy', ['name' => trans('backend.group') ]) }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">{{ trans('messages.no') }}</button>
            <button type="button" class="btn btn-outline action_confirm" data-method="delete" onclick="if ($(this).hasClass('action_confirm')) { $(this).find('form').submit(); }">{{ trans('messages.yes') }}
                {!! Form::open(array('route' => array('admin.group.destroy', 1), 'method' => 'delete')) !!}
                {!! Form::close() !!}
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $("#check-all").change(function () {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
            });
            $('#myModal').on('show', function() {
                var id = $(this).data('id'),
                    removeBtn = $(this).find('.action_confirm');
                });

            $('.confirm-delete').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#myModal').data('id', id).modal('show');
                $('#myModal').find('form').attr('action',{{ config('app.url') }}+'/admin/group/'+ id);
            });

            $('.action_confirm').click(function() {
                // handle deletion here
                var id = $('#myModal').data('id');
            });
        });
        function submitSearch()
        {
            var search = $('input[name=search]').val();
            var searchFields = $('select[name=searchFields]').val();
            var link  = "{{ route('admin.group.index',array('searchFields' => 'searchFields', 'search' => 'search')) }}";
            var link_search = link.replace('searchFields/search',searchFields + "/" + search);
            window.location = link_search;

            return false;
        }
    </script>
@endsection