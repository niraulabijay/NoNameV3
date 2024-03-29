@extends('admin.layouts.master')

@push('scripts')


    <link href="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

@endpush

@section('contents')
    <input value="+977" id="country_code" />
    <input placeholder="phone number" id="phone_number"/>
    <button onclick="smsLogin();">Login via SMS</button>


    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Buttons example</h4>
                    <p class="text-muted m-b-30 font-14">The Buttons extension for DataTables
                        provides a common set of options, API methods and styling to display
                        buttons on a page that will interact with a DataTable. The core library
                        provides the based framework upon which plug-ins can built.
                    </p>
                <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target=".addnew">Add New</button>
                    <table id="edu-data-table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Mpin</th>
                            <th>Verify</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>


                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@include('admin.user.add')
    <div class="modal fade editquiz" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

    </div>
    <div class="modal fade adduserinfo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

    </div>
@endsection

@push('scripts')
    <!-- Required datatable js -->

    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('admin/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('admin/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('admin/assets/pages/datatables.init.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#edu-data-table').DataTable({
                aaSorting: [0, 'desc'],
                processing: true,
                serverSide: true,
                bPaginate: true,
                bLengthChange: true,
                bFilter: true,
                bInfo: false,
                bAutoWidth: false,
                ajax: "{{ route('admin.json.user') }}",
                columns: [
                    {
                        data: 'count',
                        render: function (data, type, row) {
                            return row.count;
                        }
                    },
                    {
                        data: 'name',
                        render: function (data, type, row) {
                            return row.name;
                        }
                    },
                    {
                        data: 'phone',
                        render: function (data, type, row) {
                            return row.phone;
                        }
                    },
                    {
                        data: 'mpin',
                        render: function (data, type, row) {
                            return row.mpin;
                        }
                    },
                    {
                        data: 'email_verified_at',
                        render: function (data, type, row) {
                            return data != null ? '<i class="ion-thumbsup text-primary"></i>' : '<i class="ion-thumbsdown text-danger"></i>';

                        }
                    },
                    {data: 'status', name: 'status',
                        render: function(data, type, row) {
                            if(data==1){
                                return '<button data-id=' + row.id + ' class="btn-chnage-status btn btn-sm btn-default text-primary btn-outline-primary"><i class="ion-toggle-filled"></i> </button>';
                            }
                            else{
                                return '<button data-id=' + row.id + ' class="btn-chnage-status btn btn-sm btn-default text-danger btn-outline-danger"><i class="ion-toggle"></i> </button>';
                            }
                        }
                    },
                    {
                        data: 'date',
                        render: function (data, type, row) {
                            return row.date;
                        }
                    },
                    {
                        data: 'id',
                        orderable: false,
                        render: function (data, type, row) {
                            var actions = '';
                            actions += "<button type='submit' class='btn btn-primary btn-icon-text mr-2 p-1 btn-add-row' data-id=" + row.id + "><i class=' mdi mdi-database-plus btn-icon-prepend'></i></button>";
                            actions += "<button type='submit' class='btn btn-dark btn-icon-text mr-2 p-1 btn-edit-row' data-id=" + row.id + "><i class=' mdi mdi-grease-pencil btn-icon-prepend'></i></button>";
                            actions += "<button type='submit' class='btn btn-danger btn-icon-text p-1 btn-delete-row' data-id=" + row.id + "><i class=' mdi mdi-delete btn-icon-prepend'></i></button>";
                            return actions;
                        }
                    },
                ]
            });
        });
    </script>

    <script>
        $(document).on('submit', '#eduForm', function (e) {
            e.preventDefault();
            $(this).attr('disabled');
            var form = new FormData($('#eduForm')[0]);
            var params = $('#eduForm').serializeArray();

            var hideFormModal = $('#eduForm').val();
            console.log(hideFormModal);

            var myUrl = "{{ route('admin.store.user') }}";

            $.each(params, function (i, val) {
                form.append(val.name, val.value)
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: myUrl,
                contentType: false,
                processData: false,
                data: form,
                beforeSend: function (data) {

                    $("#eduFormSubmit").attr("disabled", true);
                    $('#eduFormSubmit').html('Loading...');




                },
                success: function (data) {
                    swal(
                        {
                            title: data.title,
                            text: data.text,
                            type: data.status,
                        }
                    );
                    if(data.status == 'success'){
                        $('#eduForm')[0].reset();
                        $('.addnew').modal('hide');
                    }
                    $('#edu-data-table').DataTable().ajax.reload();
                },
                error: function (err) {
                    if (err.status == 422) {
                        $('#eduFormSubmit').html('Submit');
                        $("#eduFormSubmit").attr("disabled", false);
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>').fadeOut(15000));
                        });
                    }
                },
                complete: function () {


                    $("#eduFormSubmit").attr("disabled", false);
                    $('#eduFormSubmit').html('Submit');
                    $('.addnew').modal('hide');

                }
            });
        });
    </script>

    <script>
        $(document).on('submit', '#userInfoForm', function (e) {
            e.preventDefault();
            $(this).attr('disabled');
            var form = new FormData($('#userInfoForm')[0]);
            var params = $('#userInfoForm').serializeArray();

            var hideFormModal = $('#userInfoForm').val();
            console.log(hideFormModal);

            var myUrl = "{{ route('admin.store.userinfo') }}";

            $.each(params, function (i, val) {
                form.append(val.name, val.value)
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: myUrl,
                contentType: false,
                processData: false,
                data: form,
                beforeSend: function (data) {

                    $("#eduFormSubmit").attr("disabled", true);
                    $('#eduFormSubmit').html('Loading...');




                },
                success: function (data) {
                    swal(
                        {
                            title: data.title,
                            text: data.text,
                            type: data.status,
                        }
                    );
                    if(data.status == 'success'){
                        $('#eduForm')[0].reset();
                        $('.adduserinfo').modal('hide');
                    }
                    $('#edu-data-table').DataTable().ajax.reload();
                },
                error: function (err) {
                    if (err.status == 422) {
                        $('#eduFormSubmit').html('Submit');
                        $("#eduFormSubmit").attr("disabled", false);
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>').fadeOut(15000));
                        });
                    }
                },
                complete: function () {


                    $("#eduFormSubmit").attr("disabled", false);
                    $('#eduFormSubmit').html('Submit');
                    $('.adduserinfo').modal('hide');

                }
            });
        });
    </script>

    <script>
        $(document).on("click", ".btn-edit-row", function (e) {
            e.preventDefault();
            $this = $(this);
            var id = $this.attr('data-id');

            var tempEditUrl = "{{ route('admin.edit.user', ':id') }}";
            tempEditUrl = tempEditUrl.replace(':id', id);
            console.log(tempEditUrl);
            var $modal = $('.editquiz');
            $modal.load(tempEditUrl, function (response) {
                $modal.modal('show');
            });
        });

    </script>

    <script>
        $(document).on("click", ".btn-add-row", function (e) {
            e.preventDefault();
            $this = $(this);
            var id = $this.attr('data-id');

            var tempEditUrl = "{{ route('admin.add.userinfo', ':id') }}";
            tempEditUrl = tempEditUrl.replace(':id', id);
            console.log(tempEditUrl);
            var $modal = $('.adduserinfo');
            $modal.load(tempEditUrl, function (response) {
                $modal.modal('show');
            });
        });

    </script>

    <script>
        $(document).on('click', '.btn-chnage-status', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var tempDeleteUrl = "{{ route('admin.changestatus.user', ':id') }}";
            tempDeleteUrl = tempDeleteUrl.replace(':id', id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: tempDeleteUrl,
                beforeSend: function (data) {
                    $(this).attr("disabled", true);

                },
                success: function (data) {

                    if(data.status == 'success'){

                        $('#edu-data-table').DataTable().ajax.reload();
                    }
                },
                error: function (err) {
                    if (err.status == 422) {
                        $(this).attr("disabled", false);
                    }
                },
                complete: function () {
                    $(this).attr("disabled", false);
                }
            });



        });
    </script>

    <script>
        $(document).on('submit', '#eduFormUpdate', function (e) {
            e.preventDefault();
            $(this).attr('disabled');
            var form = new FormData($('#eduFormUpdate')[0]);
                var params = $('#eduFormUpdate').serializeArray();

            var hideFormModal = $('#eduFormUpdate').val();
            console.log(hideFormModal);

            var myUrl = "{{ route('admin.update.user') }}";

            $.each(params, function (i, val) {
                form.append(val.name, val.value)
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: myUrl,
                contentType: false,
                processData: false,
                data: form,
                beforeSend: function (data) {

                    $("#eduFormUpdate").attr("disabled", true);
                    $('#eduFormUpdate').html('Loading...');

                },
                success: function (data) {
                    swal(
                        {
                            title: data.title,
                            text: data.text,
                            type: data.status,
                        }
                    );
                    if(data.status == 'success'){
                        $('#eduFormUpdate')[0].reset();
                        $('.editquiz').modal('hide');
                    }
                    $('#edu-data-table').DataTable().ajax.reload();
                },
                error: function (err) {
                    if (err.status == 422) {
                        $('#eduFormUpdate').html('Submit');
                        $("#eduFormUpdate").attr("disabled", false);
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>').fadeOut(15000));
                        });
                    }
                },
                complete: function () {


                    $("#eduFormUpdate").attr("disabled", false);
                    $('#eduFormUpdate').html('Submit');
                    $('.editquiz').modal('hide');

                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.btn-delete-row', function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var tempDeleteUrl = "{{ route('admin.delete.user', ':id') }}";
            tempDeleteUrl = tempDeleteUrl.replace(':id', id);

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                buttonsStyling: false
            }).then(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    url: tempDeleteUrl,
                    beforeSend: function (data) {
                        $(this).attr("disabled", true);

                    },
                    success: function (data) {
                        if (data) {
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );

                        }
                        $('#edu-data-table').DataTable().ajax.reload();
                    },
                    error: function (err) {
                        if (err.status == 422) {
                            $(this).attr("disabled", false);
                        }
                    },
                    complete: function () {
                        $(this).attr("disabled", false);
                    }
                });

            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                    )
                }
            })



        });
    </script>

@endpush
