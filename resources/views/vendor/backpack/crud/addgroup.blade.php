@extends('backpack::layout')
@section('header')
    {{ $categorie_group->toJson() }}
    <section class="content-header">
        <h1>
            <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
            <small>{{ trans('backpack::crud.all') }} <span class="text-lowercase">{{ $crud->entity_name_plural }}</span> {{ trans('backpack::crud.in_the_database') }}.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
            <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">{{ trans('backpack::crud.list') }}</li>
        </ol>
    </section>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row">

        <!-- THE ACTUAL CONTENT -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-header {{ $crud->hasAccess('create')?'with-border':'' }}">

                    @include('crud::inc.button_stack', ['stack' => 'top'])

                    <div id="datatable_button_stack" class="pull-right text-right"></div>
                </div>

                <div class="box-body table-responsive">

                    {{-- Backpack List Filters --}}
                    @if ($crud->filtersEnabled())
                        @include('crud::inc.filters_navbar')
                    @endif

                    <table id="crudTable" class="table table-striped table-hover display">
                        <thead>
                        <tr>
                            @if ($crud->details_row)
                                <th data-orderable="false"></th> <!-- expand/minimize button column -->
                            @endif

                            {{-- Table columns --}}
                            @foreach ($crud->columns as $column)
                                <th {{ isset($column['orderable']) ? 'data-orderable=' .var_export($column['orderable'], true) : '' }}>
                                    {{ $column['label'] }}
                                </th>
                            @endforeach

                            @if ( $crud->buttons->where('stack', 'line')->count() )
                                <th data-orderable="false">{{ trans('backpack::crud.actions') }}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            @if ($crud->details_row)
                                <th></th> <!-- expand/minimize button column -->
                            @endif

                            {{-- Table columns --}}
                            @foreach ($crud->columns as $column)
                                <th>{{ $column['label'] }}</th>
                            @endforeach

                            @if ( $crud->buttons->where('stack', 'line')->count() )
                                <th>{{ trans('backpack::crud.actions') }}</th>
                            @endif
                        </tr>
                        </tfoot>
                    </table>

                </div><!-- /.box-body -->

                @include('crud::inc.button_stack', ['stack' => 'bottom'])

            </div><!-- /.box -->
        </div>

    </div>

@endsection

@section('after_styles')
    <!-- DATA TABLES -->
    <link href="{{ asset('vendor/adminlte/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/list.css') }}">

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->
    @stack('crud_list_styles')
@endsection

@section('after_scripts')
    <!-- DATA TABLES SCRIPT -->
    <script src="{{ asset('vendor/adminlte/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
    <script src="{{ asset('vendor/backpack/crud/js/form.js') }}"></script>
    <script src="{{ asset('vendor/backpack/crud/js/list.js') }}"></script>

    @if ($crud->exportButtons())
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js" type="text/javascript"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js" type="text/javascript"></script>
        <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js" type="text/javascript"></script>
        <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js" type="text/javascript"></script>
        <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js" type="text/javascript"></script>
    @endif

    <script src="{{ asset('vendor/adminlte/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {

                    @if ($crud->exportButtons())
            var dtButtons = function(buttons){
                    var extended = [];
                    for(var i = 0; i < buttons.length; i++){
                        var item = {
                            extend: buttons[i],
                            exportOptions: {
                                columns: [':visible']
                            }
                        };
                        switch(buttons[i]){
                            case 'pdfHtml5':
                                item.orientation = 'landscape';
                                break;
                        }
                        extended.push(item);
                    }
                    return extended;
                }
                    @endif

            var table = $("#crudTable").DataTable({
                    "pageLength": {{ $crud->getDefaultPageLength() }},
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{ trans('backpack::crud.all') }}"]],
                    /* Disable initial sort */
                    "aaSorting": [],



                    "columnDefs": [
                        {

                            // The `data` parameter refers to the data for the cell (defined by the
                            // `data` option, which defaults to the column being worked with, in
                            // this case `data: 0`.
                            "render": function ( data, type, row ,meta) {
                                var emparr = {{ $categorie_group->toJson() }};
                                var empid = $(data).find("input").attr("empid");
                                var selectedrow = meta.row+1;
                                var tr = $("#crudTable tbody tr:nth-child("+selectedrow+")");
                                if((($.inArray(parseInt(empid),emparr))>-1)){
                                    tr.addClass('success');
                                }




                                var checked = (($.inArray(parseInt(empid),emparr))>-1) ? "checked" : "";



                                return '<input class="empcheckbox" name="checkmark" id="checking" empid="'+empid+'" '+ checked +' type="checkbox">';
                                //checkboxproccess(empid,input);
                            },
                            "targets": 0
                        },
                        { "visible": false,  "targets": [ 3 ] }
                    ],





                    "language": {
                        "emptyTable":     "{{ trans('backpack::crud.emptyTable') }}",
                        "info":           "{{ trans('backpack::crud.info') }}",
                        "infoEmpty":      "{{ trans('backpack::crud.infoEmpty') }}",
                        "infoFiltered":   "{{ trans('backpack::crud.infoFiltered') }}",
                        "infoPostFix":    "{{ trans('backpack::crud.infoPostFix') }}",
                        "thousands":      "{{ trans('backpack::crud.thousands') }}",
                        "lengthMenu":     "{{ trans('backpack::crud.lengthMenu') }}",
                        "loadingRecords": "{{ trans('backpack::crud.loadingRecords') }}",
                        "processing":     "<img src='{{ asset('vendor/backpack/crud/img/ajax-loader.gif') }}' alt='{{ trans('backpack::crud.processing') }}'>",
                        "search":         "{{ trans('backpack::crud.search') }}",
                        "zeroRecords":    "{{ trans('backpack::crud.zeroRecords') }}",
                        "paginate": {
                            "first":      "{{ trans('backpack::crud.paginate.first') }}",
                            "last":       "{{ trans('backpack::crud.paginate.last') }}",
                            "next":       "{{ trans('backpack::crud.paginate.next') }}",
                            "previous":   "{{ trans('backpack::crud.paginate.previous') }}"
                        },
                        "aria": {
                            "sortAscending":  "{{ trans('backpack::crud.aria.sortAscending') }}",
                            "sortDescending": "{{ trans('backpack::crud.aria.sortDescending') }}"
                        },
                        "buttons": {
                            "copy":   "{{ trans('backpack::crud.export.copy') }}",
                            "excel":  "{{ trans('backpack::crud.export.excel') }}",
                            "csv":    "{{ trans('backpack::crud.export.csv') }}",
                            "pdf":    "{{ trans('backpack::crud.export.pdf') }}",
                            "print":  "{{ trans('backpack::crud.export.print') }}",
                            "colvis": "{{ trans('backpack::crud.export.column_visibility') }}"
                        },
                    },
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{!! url($crud->route.'/search').'?'.Request::getQueryString() !!}",
                        "type": "POST"
                    },

                        @if ($crud->exportButtons())
                    // show the export datatable buttons
                    dom:
                    "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-4'i><'col-sm-4'B><'col-sm-4'p>>",
                    buttons: dtButtons([
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5',
                        'print',
                        'colvis'
                    ]),
                        @endif
                });

            // override ajax error message
            $.fn.dataTable.ext.errMode = 'none';
            {{--$('#crudTable').on('error.dt', function(e, settings, techNote, message) {--}}
                {{--new PNotify({--}}
                    {{--type: "error",--}}
                    {{--title: "{{ trans('backpack::crud.ajax_error_title') }}",--}}
                    {{--text: "{{ trans('backpack::crud.ajax_error_text') }}"--}}
                {{--});--}}
            {{--});--}}

            @if ($crud->exportButtons())
            // move the datatable buttons in the top-right corner and make them smaller
            table.buttons().each(function(button) {
                if (button.node.className.indexOf('buttons-columnVisibility') == -1)
                {
                    button.node.className = button.node.className + " btn-sm";
                }
            })
            $(".dt-buttons").appendTo($('#datatable_button_stack' ));
            @endif

            $.ajaxPrefilter(function(options, originalOptions, xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                    return xhr.setRequestHeader('X-XSRF-TOKEN', token);
                }
            });

            // make the delete button work in the first result page
            register_delete_button_action();

            // make the delete button work on subsequent result pages
            $('#crudTable').on( 'draw.dt',   function () {
                register_delete_button_action();

                @if ($crud->details_row)
                register_details_row_button_action();
                @endif
            } ).dataTable();

            function register_delete_button_action() {
                $("[data-button-type=delete]").unbind('click');
                // CRUD Delete
                // ask for confirmation before deleting an item
                $("[data-button-type=delete]").click(function(e) {
                    e.preventDefault();
                    var delete_button = $(this);
                    var delete_url = $(this).attr('href');

                    if (confirm("{{ trans('backpack::crud.delete_confirm') }}") == true) {
                        $.ajax({
                            url: delete_url,
                            type: 'DELETE',
                            success: function(result) {
                                // Show an alert with the result
                                new PNotify({
                                    title: "{{ trans('backpack::crud.delete_confirmation_title') }}",
                                    text: "{{ trans('backpack::crud.delete_confirmation_message') }}",
                                    type: "success"
                                });
                                // delete the row from the table
                                delete_button.parentsUntil('tr').parent().remove();
                            },
                            error: function(result) {
                                // Show an alert with the result
                                new PNotify({
                                    title: "{{ trans('backpack::crud.delete_confirmation_not_title') }}",
                                    text: "{{ trans('backpack::crud.delete_confirmation_not_message') }}",
                                    type: "warning"
                                });
                            }
                        });
                    } else {
                        new PNotify({
                            title: "{{ trans('backpack::crud.delete_confirmation_not_deleted_title') }}",
                            text: "{{ trans('backpack::crud.delete_confirmation_not_deleted_message') }}",
                            type: "info"
                        });
                    }
                });
            }


            @if ($crud->details_row)
            function register_details_row_button_action() {
                // var crudTable = $('#crudTable tbody');
                // Remove any previously registered event handlers from draw.dt event callback
                $('#crudTable tbody').off('click', 'td .details-row-button');

                // Make sure the ajaxDatatables rows also have the correct classes
                $('#crudTable tbody td .details-row-button').parent('td')
                    .removeClass('details-control').addClass('details-control')
                    .removeClass('text-center').addClass('text-center')
                    .removeClass('cursor-pointer').addClass('cursor-pointer');

                // Add event listener for opening and closing details
                $('#crudTable tbody td.details-control').on('click', function () {
                    var tr = $(this).closest('tr');
                    var btn = $(this).find('.details-row-button');
                    var row = table.row( tr );

                    if ( row.child.isShown() ) {
                        // This row is already open - close it
                        btn.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
                        $('div.table_row_slider', row.child()).slideUp( function () {
                            row.child.hide();
                            tr.removeClass('shown');
                        } );
                    }
                    else {
                        // Open this row
                        btn.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
                        // Get the details with ajax
                        $.ajax({
                            url: '{{ url($crud->route) }}/'+btn.data('entry-id')+'/details',
                            type: 'GET',
                            // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                            // data: {param1: 'value1'},
                        })
                            .done(function(data) {
                                // console.log("-- success getting table extra details row with AJAX");
                                row.child("<div class='table_row_slider'>" + data + "</div>", 'no-padding').show();
                                tr.addClass('shown');
                                $('div.table_row_slider', row.child()).slideDown();
                                register_delete_button_action();
                            })
                            .fail(function(data) {
                                // console.log("-- error getting table extra details row with AJAX");
                                row.child("<div class='table_row_slider'>{{ trans('backpack::crud.details_row_loading_error') }}</div>").show();
                                tr.addClass('shown');
                                $('div.table_row_slider', row.child()).slideDown();
                            })
                            .always(function(data) {
                                // console.log("-- complete getting table extra details row with AJAX");
                            });
                    }
                } );
            }

            register_details_row_button_action();
            @endif














            $('#crudTable tbody').on('click', 'tr', function (e) {

                var tr = this;
                var jtr = $(this).find('.empcheckbox');


                var grpid = $(this).children().children().attr('empid');
                var catid = {{ $cat_id }}
                $.ajax({
                    type:"POST",
                    url:"",
                    success: function(data) {

                        if(data.saving == 'success'){
                            console.log('success');
                            if(data.actions == 'attach'){

                                jtr.prop('checked',true);
                                $(tr).addClass('success');

                                new PNotify({
                                    title: "{{ trans('backpack::crud.operator_success') }}",
                                    text: "{{ trans('backpack::crud.operator_group_attach_success') }}",
                                    type: "success"
                                });

                            }else if(data.actions == 'detach'){

                                jtr.prop('checked',false);
                                $(tr).removeClass('success');

                                new PNotify({
                                    title: "{{ trans('backpack::crud.operator_success') }}",
                                    text: "{{ trans('backpack::crud.operator_group_detach_success') }}",
                                    type: "success"
                                });
                            }

                        }else{
                            console.log('faile');

                        }
                    },
                    error:function (jqXHR, textStatus, errorThrown) {

                        new PNotify({
                            title: "{{ trans('backpack::crud.operator_fail') }}",
                            text: "{{ trans('backpack::crud.operator_send_fail') }}",
                            type: "error"
                        });

                        console.log(textStatus);
                    },
                    data:{catid: grpid , groupid: grpid },
                });




            });



















        });
    </script>

    <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
    @stack('crud_list_scripts')
@endsection
