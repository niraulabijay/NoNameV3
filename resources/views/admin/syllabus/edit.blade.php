

<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0">Update Flash Card</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="eduFormUpdate" method="post">
                <input type="hidden" value="{{ $syllabus->id }}" name="flashcard_id">

                <div class="form-group">
                    <label>Note Title</label>
                    <input type="text" value="{{ $syllabus->title }}" class="form-control" name="title" required placeholder="Enter Title"/>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="summernote" name="description">{{ $syllabus->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>Select Class</label>
                    <select class="custom-select selectforchild" data-type="class" name="class_id">
                        <option selected="">Select Chapter</option>
                        @foreach($contents as $content)
                            <option value="{{ $content->id }}">{{ $content->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="addsubject">
                        @include('admin.syllabus.select-subject')
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-light @if($syllabus->status == 1) active @endif ">
                            <input type="radio" name="status" value="1" id="option1" @if($syllabus->status == 1) checked @endif> Active
                        </label>
                        <label class="btn btn-light @if($syllabus->status == 0) active @endif ">
                            <input type="radio" name="status" value="0" id="option2" @if($syllabus->status == 0) checked @endif> Inactive
                        </label>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" id="eduFormUpdate" class="btn btn-danger waves-effect waves-light pull-right">Submit</button>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    jQuery(document).ready(function(){
        $('.summernote').summernote({
            height: 150,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                 // set focus to editable area after initializing summernote
        });
    });
</script>
