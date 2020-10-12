

<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0">Update Flash Card</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="eduFormUpdate" method="post">
                <input type="hidden" value="{{ $notification->id }}" name="notification_id">

                <div class="form-group">
                    <label>Note Title</label>
                    <input type="text" value="{{ $notification->title }}" class="form-control" name="title" required placeholder="Enter Title"/>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="summernote" name="notification">{{ $notification->notification }}</textarea>
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
