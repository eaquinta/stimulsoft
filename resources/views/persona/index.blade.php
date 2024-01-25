@extends('layouts.app')

@section('title', 'Personas')

@section('content')
    {{-- edit Persona modal start --}}
    @include('persona._view')
    {{-- add new Persona modal start --}}
    @include('persona._create')
    {{-- edit Persona modal start --}}
    @include('persona._edit')
    {{-- edit Persona modal start --}}
    @include('common._audit', ['entidad' => 'persona'])


    <div class="container-fluid">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="mb-1 mb-lg-3 breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> {{ __('Inicio') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Persons') }}</li>
            </ol>
        </nav>
        <div class="row my-1 my-lg-4">
        <div class="px-1 col-lg-12">
            <div class="card shadow border-dark">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="text-secondary mb-0" style="line-height: 1;">Personas</h3>
                    <span class="text-muted card-text fs-rem-80">Gestión de Personas</span>
                </div>
                <div>
                    <button class="btn btn-outline-secondary rounded-0" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i class="fas fa-plus me-sm-2"></i><div class="d-none d-sm-inline">Nueva {{ __('Persona') }}</div></button>
                    <button class="btn btn-outline-secondary rounded-0" id="#report_persona_btn"><i class="fas fa-print me-sm-2"></i><div class="d-none d-sm-inline">Reporte</div></button>
                </div>
            </div>
            <div class="card-body px-2 p-lg-5" id="show_all_personas">
                <div class="table-responsive" style="overflow-y: visible;">
                    <table id="grid" class="table table-hover inverted-striped" width="100%" style="font-size: 0.875rem;">
                        <thead class="">
                            <tr>
                                <th>{{-- EXPAND --}}</th>
                                <th><div class="header">Id</div></th>
                                <th><div id="search-2"></div><div class="header">Foto</div></th>
                                <th><div id="search-3"></div><div class="header">Nombre</div></th>
                                <th><div id="search-4"></div><div class="header">E-mail</div></th>
                                <th><div id="search-5"></div><div class="header">Teléfono</div></th>
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
                    url: "{{ route('personas.datatable') }}",
                    beforeSend: function() {
                        $("#grid tbody").LoadingOverlay("show", {
                            maxSize: 50
                        });
                    },
                    complete: function() {
                        $("#grid tbody").LoadingOverlay("hide");
                    },
                },
                order: [1, 'asc'],
                columns: [
                // For Responsive
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
                },
                {
                    class: 'align-bottom',
                    data: 'id',
                    name: 'id'
                }, {
                    class: 'align-bottom min-width-25 text-center',
                    data: 'foto',
                    name: 'foto',
                    width: "30px",
                    responsivePriority: 3,
                    render: function(data) {
                        if(data){
                            return `<img src="storage/images/${data}" width="50" class="img-thumbnail rounded-circle">`;
                        } else {
                            return `<img src="/imgs/foto-null.jpg" width="50" class="img-thumbnail rounded-circle">`;
                        }

                    }
                }, {
                    class: 'align-bottom min-width-150',
                    data: 'nombre_completo',
                    name: 'nombre_compelto',
                    responsivePriority: 2,
                }, {
                    class: 'align-bottom min-width-150',
                    data: 'telefono',
                    name: 'telefono'
                },
                {
                    class: 'align-bottom text-center',
                    data: 'telefono',
                    name: 'telefono',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: "align-bottom text-center",
                    width: "45px",
                    responsivePriority: 1,
                }, ]
            });
        let dataTable;

        $(function() {
            const baseURL = "/personas";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                    filter_type: "none"
                },{
                    column_number: 3,
                    filter_type: "text",
                    filter_default_label: "Buscar Nombre",
                    filter_container_id: "search-3"
                },{
                    column_number: 5,
                    filter_type: "text",
                    filter_default_label: "Teléfono",
                    filter_container_id: "search-5"
                },
            ]);

            // VIEW
            $('#grid').on('click', '.view', function(e) {
                e.preventDefault();
                const id = $(this).data('model-id');
                const cn = '#viewPersonaModal';

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
                            $(`${cn} #id`).text(data.id);
                            $(`${cn} #primer_nombre`).val(data.primer_nombre);
                            $(`${cn} #segundo_nombre`).val(data.segundo_nombre);
                            $(`${cn} #tercer_nombre`).val(data.tercer_nombre);
                            $(`${cn} #primer_apellido`).val(data.primer_apellido);
                            $(`${cn} #segundo_apellido`).val(data.segundo_apellido);
                            $(`${cn} #apellido_casada`).val(data.apellido_casada);
                            //$(`${cn} #estado`).html('<span class="badge ' + (data.estado ? 'bg-success' : 'bg-danger') + '">' + (data.estado ? 'activo' : 'inactivo') + '</span>');
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
            });

            // DO-CREATE
            $("#add_persona_form").submit(function(e) {
                e.preventDefault();
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
                        $("#add_persona_btn").prop('disabled',true);
                    },
                    success: function(r) {
                        if (r.status == 200) {
                            jshelper.success(r.messages);
                            fetchPersonas();
                            $("#add_persona_form")[0].reset();
                            $("#addEmployeeModal").modal('hide');
                        } else if (r.status == 400) {
                            showError('#primer_nombre',r.messages.primer_nombre);
                            showError('#primer_apellido',r.messages.primer_apellido);
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
                        $(`#add_persona_btn`).prop("disabled",false);
                    },
                });
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
                                fetchPersonas();
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
                const cn = '#edit_persona_form';
                $.ajax({
                    url: `${baseURL}/${id}`,
                    method: 'get',
                    beforeSend: function() {
                        $(this).addClass('disabled');
                    },
                    success: function(r) {
                        if(r.status == 200){
                            $(`${cn} #id`).val(r.data.id);
                            $(`${cn} #primer_nombre`).val(r.data.primer_nombre);
                            $(`${cn} #segundo_nombre`).val(r.data.segundo_nombre);
                            $(`${cn} #tercer_nombre`).val(r.data.tercer_nombre);
                            $(`${cn} #primer_apellido`).val(r.data.primer_apellido);
                            $(`${cn} #segundo_apellido`).val(r.data.segundo_apellido);
                            $(`${cn} #apellido_casada`).val(r.data.apellido_casada);
                            $(`${cn} #email`).val(r.email);
                            $("#telefono").val(r.telefono);
                            $("#post").val(r.post);
                            $("#avatar").html(`<img src="storage/images/${r.data.foto}" width="100" class="img-fluid img-thumbnail">`);
                            $("#emp_id").val(r.id);
                            $("#emp_avatar").val(r.avatar);

                            $('#editPersonaModal').modal('show');
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
            $("#edit_persona_form").submit(function(e) {
                e.preventDefault();
                let id = $('#edit_persona_form #id').val();
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
                        $("#edit_persona_btn").prop('disabled',true);
                    },
                    success: function(r) {
                        if (r.status == 200) {
                            jshelper.success(r.messages);
                            fetchPersonas();
                            $("#edit_persona_form")[0].reset();
                            $("#editPersonaModal").modal('hide');
                        } else if (r.status == 400) {
                            showError('#primer_nombre',r.messages.primer_nombre);
                            showError('#primer_apellido',r.messages.primer_apellido);
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
                        $(`#edit_persona_btn`).prop("disabled",false);
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
                                            `<td data-bs-toggle="collapse" href="#collapseRow${i}" role="button" aria-expanded="false" aria-controls="collapseRow${i}">
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
                                $(`#modal-persona-audits-label`).html("Auditoria");
                                $('#modal-persona-audits').modal('show');
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

            function fetchPersonas() {
                dataTable.ajax.reload();
            }

            fetchPersonas();
        });
    </script>
@endsection
