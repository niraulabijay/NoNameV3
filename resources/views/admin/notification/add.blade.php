<div class="modal fade addnew" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Send New Notifaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eduForm" method="post">
                    <div class="form-group">
                        <label>Note Title</label>
                        <input type="text" class="form-control" name="title" required placeholder="Enter Title"/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="summernote" name="notification"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Pusher5 Notification</label>
                        <br>
                        <input type="radio" name="pusher" value="1" checked>Yes<br>
                        <input type="radio" name="pusher" value="0" >No
                    </div>
                    <div class="form-group ">
                        <label for="select_class">Select Class</label>
                        <select name="class_id" id="select_class" class="form-control noPusher" disabled required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="eduFormSubmit" class="btn btn-danger waves-effect waves-light pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
