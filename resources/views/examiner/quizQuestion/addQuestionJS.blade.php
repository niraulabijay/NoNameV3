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

    //Event to display image on change
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_preview')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

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
//        var no_errors = validate();
        var no_errors = true;
        if(no_errors){
            var tempUrl = "{{ route('examiner.quiz.store_question',':id') }}";
            tempUrl = tempUrl.replace(':id','{{$quiz->id}}');
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
                    $('#success').show();
                    $('#success').html("Form Submit Successful");
                    $('#edu-data-table').DataTable().ajax.reload();
                },
                error: function (err) {
                    $('#formHasErrors').show();
                    $('#backend').empty();
                    $('#backend').html(err.responseText);
                },
                complete: function () {
                    $(this).attr("disabled", false);
                    $('#add_question')[0].scrollIntoView({
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
            $('#add_question')[0].scrollIntoView({
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
        let grade = $('#grade').val();
        if(grade === null || grade === ""){
            count += 1;
            $('#errorGrade').html("*Please Select Grade");
        }
        let subject = $('#subject');
        if((subject) && (subject.val() === null || subject.val() === "")){
            count += 1;
            $('#errorSubject').html("*Please Select Subject");
        }
        let chapter = $('#chapter');
        if((chapter) && (chapter.val() === null || chapter.val() === "")){
            count += 1;
            $('#errorChapter').html("*Please Select Chapter");
        }
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
