<div class="modal fade addnew" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">New Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eduForm" method="post">
                    <div class="form-group">
                        <label>Quiz Title</label>
                        <input type="text" class="form-control" name="title" required placeholder="Enter Title"/>
                    </div>

                    <div class="form-group">
                        <label>Select Class</label>
                        <select class="custom-select selectforchild" data-type="class" name="class_id">
                            <option selected="">Select Class</option>
                            @foreach($contents as $content)
                                <option value="{{ $content->id }}">{{ $content->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="addsubject">

                    </div>
                    <hr>
                    <label>Quiz Time</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="number" min="0" max="4" step="1" onkeydown="return false" class="form-control" name="hour" placeholder="Set Hours (Use control Buttons) --> "/>
                                <label>Hour</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="number" min="0" max="59" step="1" pattern="[0-9]" class="form-control" name="minute" placeholder="Set Minutes"/>
                                <label>Minute</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Total Question To Assign</label>
                                <input type="number" step="1" min="20" max="200" class="form-control" name="total_question" placeholder="Total Question To Assign"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Quiz Description</label>
                        <textarea class="summernote" id="description_add" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" checked value="1" class="custom-control-input" id="hideFormModal" data-parsley-multiple="groups"
                            >
                            <label class="custom-control-label" for="customCheck1">Exit Model After Success!!</label>
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
