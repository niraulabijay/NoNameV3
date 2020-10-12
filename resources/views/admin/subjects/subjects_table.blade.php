<table id="danke_table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Course</td>
        <td>Code</td>
        <td>Learnable</td>
        <td>Practiceable</td>
        <td>Testable</td>
        <td>Time</td>
        <td>Action</td>
    </tr>
    </thead>
    @foreach($subject_type->contents as $subject)
        <tr>
            <td>{{ $subject->id }}</td>
            <td>{{ $subject->name }}</td>
            <td>{{ $subject->parent->name }}</td>
            <td>{{ $subject->code }}</td>
            <td>
                <a href="{{ route('admin.change_subject_boolean',[$subject->id,'is_learn']) }}">
                    @if($subject->is_learn == 1) Yes @else No @endif
                </a>
            </td>
            <td>
                <a href="{{ route('admin.change_subject_boolean',[$subject->id,'is_practice']) }}">
                    @if($subject->is_practice == 1) Yes @else No @endif
                </a>
            </td>
            <td>
                <a href="{{ route('admin.change_subject_boolean',[$subject->id,'is_test']) }}">
                    @if($subject->is_test == 1) Yes @else No @endif
                </a>
            </td>
            <td>
                {{$subject->time/60}}Minutes
            </td>
            <td>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_subject{{$subject->id}}">Edit</button>

                    {{--Edit Subject Modal--}}
                    <div class="modal fade" id="edit_subject{{$subject->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="{{ route('admin.update_subject',$subject->id) }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="subject_name">Enter Subject Name:</label>
                                            <input type="text" id="subject_name" name="name" class="form-control" value="{{$subject->name}}" required>
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
                                                    <option value="{{ $course->id }}"
                                                        @if($course->id == $subject->parent_id) selected @endif >
                                                        {{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject_icon">Enter Subject Icon:</label>
                                            <input type="text" value="{{ $subject->icon }}" id="subject_icon" name="subject_icon" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject_time">Enter Test Time (currenly in dev-mode seconds):</label>
                                            <input type="number" value="{{ $subject->time }}" id="subject_time" name="time" class="form-control">
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


                <button class="btn btn-sm btn-danger">Delete</button>
            </td>
        </tr>
    @endforeach
</table>