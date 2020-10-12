<div class="modal fade" id="examiner_details{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Examiner Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eduForm" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="title" required placeholder="Enter Title"/>
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" class="form-control" name="occupation">
                    </div>
                    <div class="form-group">
                        <label>Institution</label>
                        <input type="text" class="form-control" name="institution">
                    </div>
                    <div class="addsubject">

                    </div>
                    {{--<div class="addchapter">--}}

                    {{--</div>--}}
                    <div class="form-group">
                        <label>Status</label>
                        <br>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-light active">
                                <input type="radio" name="status" value="1" id="option1" checked> Active
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="status" value="0" id="option2"> Inactive
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" id="eduFormSubmit" class="btn btn-danger waves-effect waves-light pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
