<div class="form-group">
    <label>Select Subject</label>
    <select class="custom-select selectforchild" data-type="subject" name="subject_id" >
        <option selected="">Select Chapter</option>
        @if(isset($subjectLists))
            @foreach($subjectLists as $item)
                <option @if($subject->id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach

        @else
            @foreach($contents as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach

        @endif
    </select>
</div>
