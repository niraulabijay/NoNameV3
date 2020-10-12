@extends('admin.layouts.master')

@section('styles')

    {{--Page specific styles--}}

@endsection

@section('headers')

    {{--Heading and breadcrumbs--}}
    <div class="row">
        <div class="col-sm-12">
            <div class="float-right page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active"><a href="#">Subjects</a></li>
                    {{--<li class="breadcrumb-item active">*Breadcrumb2*</li>--}}
                </ol>
            </div>
            <h5 class="page-title">Subjects</h5>
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

                    <h4 class="mt-0 header-title" style="padding-bottom: 10px">Available Subjects
                        <a href="#" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#add_subject">Add</a>
                    </h4>

                    {{--Add Subject Modal--}}
                    <div class="modal fade" id="add_subject" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('admin.store_subject') }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Subject</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="subject_name">Enter Subject Name:</label>
                                            <input type="text" id="subject_name" name="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject_type">Enter Type:</label>
                                            <select name="type" id="subject_type" class="form-control">
                                                <option value="{{ $subject_type->id }}" selected>
                                                    {{ $subject_type->name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-control">
                                            <label for="parent">Parent</label>
                                            <select name="parent_id" id="parent" required>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject_icon">Enter Subject Icon:</label>
                                            <input type="text" id="subject_icon" name="subject_icon" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject_time">Enter Test Time (currenly in dev-mode seconds):</label>
                                            <input type="number"  id="subject_time" name="time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" id="add_preparation" class="btn btn-primary">Save changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    {{--Display subjects--}}
                    @include('admin.subjects.subjects_table')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    {{--Page specific scripts--}}
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        } );
    </script>

@endsection
