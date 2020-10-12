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
            <div class="form-group">
                <label>Select Chapter</label>
                <span class="errorForm" id="errorGrade">*</span>
                <select class="custom-select selectforchild" id="grade" data-type="chapter" name="chapter_id">
                    <option value="" selected disabled>Select Chapter</option>
                    @foreach($contents as $content)
                        <option value="{{ $content->id }}">{{ $content->name }}</option>
                    @endforeach
                </select>
            </div>
            {{--<div class="addsubject">--}}

            {{--</div>--}}
            {{--<div class="addchapter">--}}

            {{--</div>--}}
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
                <textarea name="answer[]" class="summernote_answer" id="optionA" ></textarea>

            </div>
            <div class="col-md-2">
                <input type="radio" name="correct" value="0"><br>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-1">
                B.
            </div>
            <div class="col-md-9">
                <textarea name="answer[]" class="summernote_answer" id="optionB"></textarea>

            </div>
            <div class="col-md-2">
                <input type="radio" name="correct" value="1"><br>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-1">
                C.
            </div>
            <div class="col-md-9">
                <textarea name="answer[]" class="summernote_answer" id="optionC"></textarea>

            </div>
            <div class="col-md-2">
                <input type="radio" name="correct" value="2"><br>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-1">
                D.
            </div>
            <div class="col-md-9">
                <textarea name="answer[]" class="summernote_answer" id="optionD"></textarea>

            </div>
            <div class="col-md-2">
                <input type="radio" name="correct" value="3"><br>
            </div>
        </div>
    </div>
    <hr/>
    <div>
        {{--{{asset('images/addQuestionDummy.jpg')}}--}}
        <img src="" id="image_preview" class="question_add_image_preview"/>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input id="image_upload" onchange="readURL(this)" type="file" name="image" class="form-control"/>
    </div>
    <br/>
    <hr/>
    <div class="text-center">
        <button type="button" id="hide_add_question" value="exit" class="btn btn-primary">
            Hide
        </button>
        <button type="submit" id="submit_add" value="add" class="submit_button btn btn-secondary">
            Save and Add Another
        </button>
    </div>
    <p><span class="errorForm" style="display: none">Form submit error. Please check errors and try again !!</span></p>

</form>