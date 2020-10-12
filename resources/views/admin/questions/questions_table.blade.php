<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Marks</th>
        <th>Options</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($questions as $question)
        <tr>
            <td>{{ $question->id }}</td>
            <td>{!! substr($question->name,0,40) !!}</td>
            <td>{{ $question->marks }}</td>
            <td>
                {{-- <ul>
                    @if(isset($question->answers))
                        @foreach($question->answers as $answer)
                            <li>{!! $answer->name !!} ({{ $answer->correct }})</li>
                        @endforeach
                    @endif
                </ul> --}}
            </td>
            <td>
                <a href="{{ route('admin.edit_question',$question->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_question{{$question->id}}">Delete</button>

                {{-- <div class="modal fade" id="delete_question{{$question->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.question_delete',$question->id) }}" method="post">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Question</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure want to delete this question?
                                    <input type="hidde" name="id" value="{{$question->id}}">
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
                </div> --}}

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
