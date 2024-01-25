@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    {{-- edit User modal start --}}
    @include('user._view')
    {{-- add new User modal start --}}
    @include('user._create')
    {{-- edit User modal start --}}
    @include('user._edit')
    {{-- edit User modal start --}}
    @include('common._audit', ['entidad' => 'user'])

    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="mb-1 mb-lg-3 breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> {{ __('Inicio') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Users') }}</li>
            </ol>
        </nav>
        <div class="row my-1 my-lg-4">
          <div class="px-1 col-lg-12">
            <div class="card shadow border-dark">
              <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="text-secondary mb-0" style="line-height: 1;">{{ __('Users') }}</h3>
                    <span class="text-muted card-text fs-rem-80">Gestión de {{ __('Users') }}</span>
                </div>
                <div>
                    @can('user.create')
                        <button class="btn btn-outline-secondary rounded-0" id="create_user_btn" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-plus me-sm-2"></i><div class="d-none d-sm-inline">Nuevo {{ __('User') }}</div></button>
                    @endcan
                    @can('user.print')
                        <button class="btn btn-outline-secondary rounded-0" id="#report_user_btn"><i class="fas fa-print me-sm-2"></i><div class="d-none d-sm-inline">Reporte</div></button>
                    @endcan
                </div>
              </div>
              <div class="card-body px-2 p-lg-5" id="show_all_users">
                <div class="table-responsive" style="overflow-y: visible;">
                    <table id="grid" class="table table-hover inverted-striped" width="100%" style="font-size: 0.875rem;">
                        <thead class="">
                            <tr>
                                <th>{{-- Column 1 --}}</th>
                                <th><div class="header">Id</div></th>
                                <th><div id="search-3"></div><div class="header">Nombre</div></th>
                                <th><div id="search-4"></div><div class="header">Email</div></th>
                                <th><div class="header">Roles</div></th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('styles')
    {{-- Jquery --}}
    <link rel="stylesheet" href="{{ asset('content/jquery-ui-1.13.2/jquery-ui.css') }}">
    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('content/DataTables/DataTables-1.13.7/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('content/DataTables/Responsive-2.5.0/css/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/crud/datatable.css')}}">
    <link rel="stylesheet" href="{{ asset('content/yadcf-0.9.3/jquery.dataTables.yadcf.css')}}">
    <link rel="stylesheet" href="{{ asset('css/crud/yadcf.css')}}">
    <link rel="stylesheet" href="{{ asset('css/crud/view-modal.css') }}">
@endsection

@section('scripts')
    {{-- Jquery UI --}}
    <script src="{{asset('content/jquery-ui-1.13.2/jquery-ui.js')}}"></script>
    {{-- DataTables --}}
    <script src="{{ asset('content/DataTables/DataTables-1.13.7/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('content/DataTables/DataTables-1.13.7/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('content/DataTables/Responsive-2.5.0/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('content/DataTables/Responsive-2.5.0/js/responsive.bootstrap5.min.js')}}"></script>
    {{-- YADCF --}}
    <script src="{{ asset('content/yadcf-0.9.3/jquery.dataTables.yadcf.js')}}"></script>
    <script src="{{ asset('js/crud/datatable.js')}}"></script>

    <script>
        const dataTableOptions = $.extend(true, {}, defaultDataTableOptions, {
                dom: "<''f><'row'<'col-12 col-sm-6 px-0 mb-3'l><'col-12 col-sm-6 px-0 text-end'B>>r<'mb-3't>pi",
                ajax: {
                    url: "{{ route('users.datatable') }}",
                    beforeSend: function() {
                        $("#grid tbody").LoadingOverlay("show", {
                            maxSize: 50
                        });
                    },
                    complete: function() {
                        $("#grid tbody").LoadingOverlay("hide");
                    },
                    error: function (xhr, error, code) {
                        console.log(xhr, code);
                        jshelper.failure();
                    },
                },
                order: [1, 'asc'],
                columns: [
                    {
                        class: 'irrelevant',
                        data: null,
                        name: null,
                        width: "0px",
                        orderable: false,
                        searchable: false,
                        render: function() {
                            return '';
                        }
                    },{
                        class: 'align-bottom',
                        data: 'id',
                        name: 'id'
                    },{
                        class: 'align-bottom min-width-150',
                        data: 'name',
                        name: 'name',
                        responsivePriority: 2,
                    },{
                        class: 'align-bottom min-width-150',
                        data: 'email',
                        name: 'email',
                        responsivePriority: 3,
                    },{
                        class: 'align-bottom min-width-150',
                        data: 'roles',
                        name: 'roles',
                        responsivePriority: 4,
                    },{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: "align-bottom text-center",
                        width: "45px",
                        responsivePriority: 1,
                    },
                ]
            });
        let dataTable;

        $(function() {
            const baseURL = "/users";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // BIND VALIDATE
            $('#add_user_form, #edit_user_form').each(function() {
                $(this).validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 255
                        },
                        email: {
                            required: true,
                            email: true,
                            maxlength: 255
                            // Unfortunately, there is no direct equivalent of Laravel's 'unique' rule in jQuery Validate
                            // You might need to handle this validation separately via AJAX
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password_confirmation: {
                            required: true,
                            minlength: 8,
                            equalTo: '#password' // Match with the password field
                        },
                        roles: {
                            required: true,
                            minlength: 1 // Ensure at least one role is selected
                            // jQuery Validate doesn't have a direct 'exists' rule as in Laravel
                            // You might need to handle this validation separately via AJAX
                        }
                    },
                    messages: {
                        name: {
                            required: '{{ __("validation.required", ["attribute" => __("Name")]) }}',
                            maxlength: '{{ __("validation.max.string", ["attribute" => __("Name"), "max" => 255]) }}'
                        },
                        email: {
                            required: '{{ __("validation.required", ["attribute" => __("Email")]) }}'
                        },
                    },
                    //errorElement: 'div',
                    errorPlacement: function(error, element) {
                        //error.addClass('invalid-feedback');
                        //element.after(error);
                        element.siblings(".invalid-feedback").html(error.text());

                //         var $customPlacement = $(element).data('error-placement');
                // if ($customPlacement) {
                //     $(element).closest('form').find($customPlacement).html(error);
                // } else {
                //     error.insertAfter(element);
                // }
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });

            // Initialize DATATABLE
            dataTable = $('#grid').DataTable(dataTableOptions);

            // Initialize YADCF
            yadcf.init(dataTable, [
                {
                    column_number: 0,
                    filter_type: "none"
                },{
                    column_number: 1,
                    filter_type: "none"
                },{
                    column_number: 2,
                    filter_type: "text",
                    filter_default_label: "Buscar Nombre",
                    filter_container_id: "search-3"
                },{
                    column_number: 3,
                    filter_type: "text",
                    filter_default_label: "Buscar Email",
                    filter_container_id: "search-4"
                },
            ]);

            // VIEW
            $('#grid').on('click', '.view', function(e) {
                e.preventDefault();
                const id = $(this).data('model-id');
                const cn = '#viewUserModal';

                $.ajax({
                    beforeSend: function() {
                    },
                    type: "GET",
                    dataType: "json",
                    url: `${baseURL}/${id}`,
                    success: function(r) {
                        if(r.status == 200){
                            const data = r.data;
                            $(`${cn}`).modal('show');
                            $(`${cn} #id`).val(data.id);
                            $(`${cn} #name`).val(data.name);
                            $(`${cn} #email`).val(data.email);
                            $(`${cn} #created_at`).text(moment(data.created_at).format('DD/MM/YYYY'));
                            $(`${cn} #updated_at`).text(moment(data.updated_at).format('DD/MM/YYYY'));
                        } else {
                            console.log(r);
                            jshelper.failure();
                        }
                    },
                    error: function(a) {
                        jshelper.failure();
                    },
                    complete: function() {
                    },
                });
            })

            // CREATE
            $('#create_user_btn').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url: `${baseURL}/create`,
                    method: 'get',
                    dataType: 'json',
                    success: function (r, t, xhr){
                        jshelper.handleSuccess(xhr);
                        if(r.status == 200) {
                            jshelper.populateDropdown($('#roles'),r.roles);
                            $('#roles').select2({
                                theme: "bootstrap-5",
                                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                                placeholder: $(this).data('placeholder'),
                                closeOnSelect: false,
                                allowClear: true,
                            });
                            $('#addUserModal').modal('show');
                        } else {
                            console.log(r);
                            jshelper.failure();
                        }
                    },
                    error: function (e) {
                        console.log(e);
                        jshelper.failure();
                    },
                    complete: function(){
                        $(this).removeClass('disabled');
                    },
                });
            });

            // DO-CREATE
            $("#add_user_form").submit(function(e) {
                e.preventDefault();
                if ($(this).valid()){
                    const fd = new FormData(this);
                    $.ajax({
                        url: `${baseURL}`,
                        method: 'post',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#add_user_btn").prop('disabled',true);
                        },
                        success: function(r) {
                            jshelper.success(r.messages);
                            fetchUsers();
                            $("#add_user_form")[0].reset();
                            $("#addUserModal").modal('hide');
                        },
                        error: function (xhr) {
                            const parentForm = '#add_user_form';
                            if (xhr.status === 422) {  //Unprocessable Entity.
                                let m = xhr.responseJSON.messages;
                                $.each(m, function(key, value) {
                                    showError(`#${key}`,value, parentForm);   // Display error messages for each input field individually
                                });
                            } else {
                                console.log(xhr);
                                jshelper.handleError(xhr);
                            }
                        },
                        complete: function() {
                            $(`#add_user_btn`).prop("disabled",false);
                        },
                    });
                }
            });

            // DELETE
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                let id = $(this).data('model-id');
                jshelper.deleteConfirm(function() {
                    $.ajax({
                        beforeSend: function() {
                            $(this).addClass('disabled');
                        },
                        url: `${baseURL}/${id}`,
                        method: 'DELETE',
                        dataType: "json",
                        success: function(r) {
                            if (r.status == 200) {
                                toastr.success(r.messages, 'Información');
                                fetchUsers();
                            } else if(r.status == 404 || r.status == 406){
                                toastr.error(r.messages, "Alerta de Error");
                            } else {
                                console.error(r);
                                jshelper.failure();
                            }
                        },
                        error: function(e) {
                            console.error(e);
                            jshelper.failure();
                        },
                        complete: function(){
                            $(this).removeClass('disabled');
                        },
                    });
                });
            });

            // UPDATE
            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                const id = $(this).data('model-id');
                const cn = '#edit_user_form';
                $.ajax({
                    url: `${baseURL}/${id}`,
                    method: 'get',
                    beforeSend: function() {
                        $(this).addClass('disabled');
                    },
                    success: function(r) {
                        if(r.status == 200){
                            $(`${cn} #id`).val(r.data.id);
                            $(`${cn} #name`).val(r.data.name);
                            $(`${cn} #email`).val(r.data.email);
                            $('#editUserModal').modal('show');
                        } else {
                            console.log(r);
                            jshelper.failure();
                        }
                    },
                    error: function (e) {
                        console.log(e);
                        jshelper.failure();
                    },
                    complete: function(){
                        $(this).removeClass('disabled');
                    },
                });
            });

            // DO-UPDATE
            $("#edit_user_form").submit(function(e) {
                e.preventDefault();
                let id = $('#edit_user_form #id').val();
                const fd = new FormData(this);
                fd.append("_method", "PATCH");
                $.ajax({
                    url: `${baseURL}/${id}`,
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $("#edit_user_btn").prop('disabled',true);
                    },
                    success: function(r) {
                        jshelper.success(r.messages);
                        if (r.status == 200) {
                            fetchUsers();
                            $("#edit_user_form")[0].reset();
                            $("#editUserModal").modal('hide');
                        } else if (r.status == 400) {
                            showError('#name',r.messages.name, '#edit_user_form');
                            showError('#email',r.messages.email, '#edit_user_form');
                        } else {
                            console.log(r);
                            jshelper.failure();
                        }
                    },
                    error: function (e) {
                        console.log(e);
                        jshelper.failure();
                    },
                    complete: function() {
                        $(`#edit_user_btn`).prop("disabled",false);
                    },
                });
            });

            // AUDITS
            $('#grid').on('click', '.audits', function(e) {
                    e.preventDefault();
                    const id = $(this).data('model-id');
                    let o = $(this);
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: `${baseURL}/${id}/audits`,
                        beforeSend: function() {
                            o.addClass('disabled');
                        },
                        success: function(r) {
                            $("#table-audits tr:has(td)").remove();
                            if(r.status == 200){
                                r.audits.forEach((audit, i) => {
                                    let modifiedData = `
                                        <div class="row">
                                            <div class="col-4 fw-bold">Campo</div>
                                            <div class="col-4 fw-bold">Antes</div>
                                            <div class="col-4 fw-bold">Después</div>
                                        </div>`;

                                    $.each(audit.modified_data, (attribute, item) => {
                                        modifiedData += `
                                            <div class="row">
                                                <div class="col-4">${attribute}</div>
                                                <div class="col-4">${item.old || '-ND-'}</div>
                                                <div class="col-4">${item.new}</div>
                                            </div>`;
                                    });

                                    $('<tr>')
                                        .html(
                                            `<td data-bs-toggle="collapse" href="#collapseRow${i}" user="button" aria-expanded="false" aria-controls="collapseRow${i}">
                                                <i class="fas fa-plus"></i>
                                            </td>
                                            <td>${audit.user.name}</td>
                                            <td>${audit.event}</td>
                                            <td>${audit.ip_address}</td>
                                            <td>${moment(audit.created_at).format('DD/MM/YYYY hh:mm:ss')}</td>`)
                                        .appendTo('#table-audits');

                                    $('<tr class="collapse">')
                                        .attr('id', `collapseRow${i}`)
                                        .html(`
                                            <td></td>
                                            <td colspan="4">${modifiedData}</td>`)
                                        .appendTo('#table-audits');
                                });
                                $(`#modal-user-audits-label`).html("Auditoria");
                                $('#modal-user-audits').modal('show');
                            } else {
                                console.log(r);
                                jshelper.failure();
                            }

                        },
                        error: function(e) {
                            console.log(e);
                            jshelper.failure();
                        },
                        complete: function() {
                            o.removeClass('disabled');
                        }
                    });
                });

            function fetchUsers() {
                dataTable.ajax.reload();
            }

            //fetchUsers();
        });
    </script>
@endsection
