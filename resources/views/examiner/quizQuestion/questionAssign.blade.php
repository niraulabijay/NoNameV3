@extends('examiner.layouts.master')

@push('styles')

{{--Page specific styles--}}
<!-- DataTables -->
<link href="{{ asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

<!-- Summernote css -->
<link href="{{ asset('admin/assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .question_add_image_preview {
        height: 250px;
        width: auto;
    }

    .errorForm {
        color: red;
        font-size: 14px;
    }
    .jumbotron{
        padding: 2rem 1rem !important;
    }
    #formHasErrors{
        display: none;
        text-align: center;
    }
</style>

@endpush

@section('headers')

    {{--Heading and breadcrumbs--}}
    <div class="row">
        <div class="col-sm-12">
            <div class="float-right page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active"><a href="#">Questions</a></li>
                    {{--<li class="breadcrumb-item active">*Breadcrumb2*</li>--}}
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>{{ $quiz->title  }}</h3>
            <h4>Grade : {{$quiz->class_title}}</h4>
            <h4>Subject : {{$quiz->subject_title}}</h4>
            <h4>Total Questions :{{ $quiz->total_questions  }}</h4>
            <h5 class="page-title">Assign Questions</h5>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('contents')

    {{--Page Specific Content--}}
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <div class="mt-0 header-title" style="padding-bottom: 10px">
                        <a href="{{ route('examiner.quiz') }}" class="btn btn-sm btn-secondary">
                            Back To Quiz List
                        </a>
                        <button id="add_question" class="btn btn-sm btn-primary pull-right">
                            Add Question
                        </button>
                    </div>

                    <div id="add_form_block" style="border:1px solid; display: none">
                        @include('examiner.quizQuestion.addForm')
                    </div>
                    {{--Display subjects--}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title" style="padding-bottom: 10px">
                        Available Questions
                    </h4>

                    <table id="edu-data-table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                    {{--Display subjects--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

{{--Datatables--}}
<script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
{{--<script src="{{ asset('admin/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/datatables/jszip.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/datatables/pdfmake.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/datatables/vfs_fonts.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/datatables/buttons.html5.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/datatables/buttons.print.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>--}}
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
            ajax: "{{ route('examiner.json.ExaminerQuizQuestions',$quiz->id) }}",
            columns: [
                {
                    data: 'count',
                    render: function (data, type, row) {
                        return row.count;
                    }
                },
                {
                    data: 'question',
                    render: function (data, type, row) {
                        return row.question;
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
                        var tempEditUrl = "{{ route('examiner.quiz.question_assign', ':id') }}";
                        tempEditUrl = tempEditUrl.replace(':id', row.id);
                        actions += "<button type='submit' class='btn btn-dark btn-icon-text mr-2 p-1 btn-edit-row' data-id=" + row.id + "><i class=' mdi mdi-grease-pencil btn-icon-prepend'></i></button>";
                        actions += "<button type='submit' class='btn btn-danger btn-icon-text mr-2 p-1 btn-delete-row' data-id=" + row.id + "><i class=' mdi mdi-delete btn-icon-prepend'></i></button>";
                        actions += "<a href='"+tempEditUrl+"' class='btn btn-primary btn-icon-text mr-2 p-1 btn-assignQues' data-id=" + row.id + "><i class=' mdi mdi-grid btn-icon-prepend'></i></button>";
                        return actions;
                    }
                },
            ]
        });
    });
</script>

<script>
    $('#add_question').on('click',function () {
        $('#add_form_block').show();
    })
    $('#hide_add_question').on('click',function () {
        $('#add_form_block').hide();
    })
</script>

@include('examiner.quizQuestion.addQuestionJS')

@endpush
