@extends('admin.layouts.master')

@push('styles')

{{--Page specific styles--}}

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
                    <li class="breadcrumb-item"><a href="#">Question</a></li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </div>
            <h5 class="page-title" id="scroll_view"> Edit Question : {!! $question->name !!}</h5>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('contents')

    {{--<div id="question-add-form"></div>--}}
    <div class="card">
        <div class="card-body">
            <div id="formHasErrors" class="alert alert-danger">Please check errors in the form.<span id="backend"></span></div>
            <div id="success" class="alert alert-success" style="display:none;"></div>
            <form
                    method="post"
                    action="{{route('admin.store_question')}}"
                    id="question_form"
                    encType="multipart/form-data"
            >
                @csrf
                <div class="form-group jumbotron">
                    <label for="question">Enter Question Name:</label>
                    <span class="errorForm" id="errorQuestion">*</span>
                    <textarea
                            id="question"
                            name="question"
                            class="summernote_question"
                    ></textarea>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">

                        <h5><strong>Grade:</strong>{{$question->chapter->parent->parent->name}}</h5>
                        <h5><strong>Subject:</strong>{{$question->chapter->parent->name}} </h5>
                        <h5><strong>Chapter:</strong>{{$question->chapter->name}} </h5>
                        <h5><strong>Marks:</strong> {{$question->marks}}</h5>

                        <input type="hidden" name="chapter_id" value="{{ $question->chapter->id }}">
                        <input type="hidden" name="marks" value="{{ $question->marks }}">

                        <div class="form-group" style="display: none;">
                            <label>Select Grade</label>
                            <span class="errorForm" id="errorGrade">*</span>
                            <select class="custom-select selectforchild" id="grade" data-type="class" name="class_id">
                                <option value="" selected disabled>Select Grade</option>
                                @foreach($contents as $content)
                                    <option value="{{ $content->id }}">{{ $content->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="addsubject">

                        </div>
                        <div class="addchapter">

                        </div>
                        <div class="addmarks">

                        </div>
                        <span class="errorForm"></span>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="importance">Important</label>
                            {{--Sending default 0 value if none selected--}}
                            <input type="hidden" name="importance" value="0"/>
                            <br>
                            <input
                                    type="radio"
                                    name="importance"
                                    value="1"
                            /> :Yes
                            <input
                                    type="radio"
                                    name="importance"
                                    value="0"
                            /> :No
                        </div>
                        <div class="form-group">
                            <label for="">Enter Year:</label>
                            <select name="year[]" multiple="multiple" id="year" class="js-example-tokenizer" style="width: 100%">
                                @if(isset($years))
                                    @foreach($years as $year)
                                    <option value="{{$year}}" selected>{{$year}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-md-1">
                            #
                        </div>
                        <div class="col-md-9">
                            <label>Options:</label>
                            <span class="errorForm" id="errorOption">*</span>
                        </div>
                        <div class="col-md-2">
                            <label>Correct:</label>
                            <span class="errorForm" id="errorCorrect">*</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-1">
                            A.
                        </div>
                        <div class="col-md-9">
                            <textarea name="answer[{{$question->answers[0]->id}}]" class="summernote_answer" id="optionA" ></textarea>

                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="correct" value="{{$question->answers[0]->id}}"
                                @if($question->answers[0]->correct == 1) checked @endif
                            ><br>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-1">
                            B.
                        </div>
                        <div class="col-md-9">
                            <textarea name="answer[{{$question->answers[1]->id}}]" class="summernote_answer" id="optionB"></textarea>

                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="correct" value="{{$question->answers[1]->id}}"
                            @if($question->answers[1]->correct == 1) checked @endif><br>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-1">
                            C.
                        </div>
                        <div class="col-md-9">
                            <textarea name="answer[{{$question->answers[2]->id}}]" class="summernote_answer" id="optionC"></textarea>

                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="correct" value="{{$question->answers[2]->id}}"
                            @if($question->answers[2]->correct == 1) checked @endif><br>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-1">
                            D.
                        </div>
                        <div class="col-md-9">
                            <textarea name="answer[{{$question->answers[3]->id}}]" class="summernote_answer" id="optionD"></textarea>

                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="correct" value="{{$question->answers[3]->id}}"
                            @if($question->answers[3]->correct == 1) checked @endif><br>
                        </div>
                    </div>
                </div>
                <hr/>
                <div>
                    <img src="{{asset('images/addQuestionDummy.jpg')}}" id="image_preview" class="question_add_image_preview"/>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input id="image_upload" type="file" name="image" class="form-control"/>
                </div>
                <br/>
                <hr/>
                <div class="text-center">
                    <button type="submit" id="submit_exit" value="exit" class="submit_button btn btn-primary">
                        Save and Exit
                    </button>
                    {{-- <button type="submit" id="submit_add" value="add" class="submit_button btn btn-secondary">
                        Save and Add Another
                    </button> --}}
                </div>
                <p><span class="errorForm" style="display: none">Form submit error. Please check errors and try again !!</span></p>

            </form>
        </div>
    </div>

@endsection

@push('scripts')

<!--***************** CDNs *********************-->
<script src="{{ asset('admin/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

{{-- *********** SummerNote + Select2 Initializer Code ************--}}
<script>
    $("#year").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });


    jQuery(document).ready(function () {
        $('.summernote_question').summernote({
            height: 80,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                 // set focus to editable area after initializing summernote
        });
        var q = `{!! $question->name !!}`;
        $('.summernote_question').summernote('code', q);
    });
    jQuery(document).ready(function () {
        $('.summernote_answer').summernote({
            height: 50,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                 // set focus to editable area after initializing summernote
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            placeholder: 'Enter Option Text Here......(*Required)'
        });
        var a = `{!! $question->answers[0]->name !!}`;
        var b = `{!! $question->answers[1]->name !!}`;
        var c = `{!! $question->answers[2]->name !!}`;
        var d=  `{!! $question->answers[3]->name !!}`;

        $('#optionA').summernote('code', a);
        $('#optionB').summernote('code', b);
        $('#optionC').summernote('code', c);
        $('#optionD').summernote('code', d);
    });

    //check for empty fields
    //    if ($('#summernote').summernote('isEmpty')) {
    //        alert('editor content is empty');
    //    }

</script>

{{-- ******** jQuery For Select DropDown Nth Child *******--}}
<script>
    $(document).on("change", ".selectforchild", function (e) {
        // e.preventDefault();
        $this = $(this);
        var type = $this.attr('data-type');
        var id = $this.val();
        var $divsubject = $('.addsubject');
        var $divchapter = $('.addchapter');
        var $divmarks = $('.addmarks');
        var tempResponseUrl = "{{ route('admin.change.questioncontent') }}";

        $.ajax({
            type: "GET",
            url: tempResponseUrl,
            data: {
                'id': id,
                'type': type,
            },
            beforeSend: function (data) {

            },
            success: function (data) {
                if (type === "class") {
                    $divsubject.html(data);
                }
                if (type === "subject") {
                    $divchapter.html(data);
                }
                if (type === "chapter") {
                    $divmarks.html(data);
                }
            },
        });
    });
</script>

{{-- ************* Form Validation and Submit ************--}}
<script>
    $('.submit_button').on('click',function (e) {
        e.preventDefault();
        let action = e.target.value;
        $('#formHasErrors').hide();
        $('#success').hide();
        $('.errorForm').empty();
        $('#backend').empty();
        var no_errors = validate();
        console.log(no_errors);
        if(no_errors){
            var tempUrl = "{{ route('admin.update_question',$question->id) }}";
            var form = new FormData($('#question_form')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: tempUrl,
                contentType: false,
                processData: false,
                data: form,
                beforeSend: function (data) {
                    $(this).attr("disabled", true);
                },
                success: function (data) {
                    $('.errorForm').empty();
                    $('#formHasErrors').hide();
                    $('#question_form')[0].reset();
                    $('.summernote_question').summernote('reset');
                    $('#optionA').summernote('reset');
                    $('#optionB').summernote('reset');
                    $('#optionC').summernote('reset');
                    $('#optionD').summernote('reset');
                    $("#year").select2("val", "");
                    if(action === "exit"){
                        alert("Form Submit successs. You Will be Redirected Now");
                        window.location.href = '/admin/questions'
                    }else{
                        $('#success').show();
                        $('#success').html("Form Submit Successful");
                    }
                },
                error: function (err) {
                    $('#formHasErrors').show();
                    $('#backend').html('Error in Controller');
                },
                complete: function () {
                    $(this).attr("disabled", false);
                    $('#scroll_view')[0].scrollIntoView({
                        behavior: "smooth", // or "auto" or "instant"
                        block: "start" // or "end"
                    });
                }
            });
        }
        else{
            //Stop loader
            $('.errorForm').show();
            $('#formHasErrors').show();
            $('#scroll_view')[0].scrollIntoView({
                behavior: "smooth", // or "auto" or "instant"
                block: "start" // or "end"
            });
            //alert('terminate submit')
        }
    });

    function validate() {
        var count = 0;
        let question = $('.summernote_question');
        if(question.summernote('isEmpty')){
            count += 1;
            $('#errorQuestion').html("*Please Enter Question");
        }
        let marks = $('#marks').val();
        if(marks === null || marks === ""){
            count += 1;
            $('#errorMarks').html("*Please Select Marks");
        }
        // let grade = $('#grade').val();
        // if(grade === null || grade === ""){
        //     count += 1;
        //     $('#errorGrade').html("*Please Select Grade");
        // }
        // let subject = $('#subject');
        // if((subject) && (subject.val() === null || subject.val() === "")){
        //     count += 1;
        //     $('#errorSubject').html("*Please Select Subject");
        // }
        // let chapter = $('#chapter');
        // if((chapter) && (chapter.val() === null || chapter.val() === "")){
        //     count += 1;
        //     $('#errorChapter').html("*Please Select Chapter");
        // }
        let option_fields = $('.summernote_answer');
        if($('#optionA').summernote('isEmpty') || $('#optionB').summernote('isEmpty') || $('#optionC').summernote('isEmpty') || $('#optionD').summernote('isEmpty')){
            count += 1;
            $('#errorOption').html("*Please Enter All 4 Options");
        }
        let correct = $("input[name='correct']:checked").val();
        if(!correct){
            $('#errorCorrect').html("Please Select 1 Correct Option")
        }
        return count == 0 ? true : false ;
    }
</script>

@endpush
