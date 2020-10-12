<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <td>ID</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Is Examiner?</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>
                @if(isset($user->examiner) && $user->examiner->status ==1 )
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#change_status{{$user->id}}">Yes</button>

                @else
                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#change_status{{$user->id}}">No</button>
                @endif
                    <div class="modal fade" id="change_status{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0">Change Status?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure want to change status?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <a href="{{ route('admin.examinerStatus',$user->id) }}" id="change_status" class="btn btn-primary">Yes
                                        </a>
                                    </div>
                                </div>
                            </div>
                    </div>

            </td>
            <td>
                @if(isset($user->examiner))
                    <button class="btn btn-outline-primary"
                            data-toggle="modal" data-target="#examiner_details{{$user->id}}">Details</button>

                    @include('admin.examiner.details')
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
