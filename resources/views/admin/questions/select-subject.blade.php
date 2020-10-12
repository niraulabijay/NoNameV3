<div class="form-group">
    <label>Select Subject</label>
    <span class="errorForm" id="errorSubject">*</span>
    <select class="custom-select selectforchild" id="subject" data-type="subject" name="subject_id" >
        <option value="" selected disabled>Select Subject</option>
        @foreach($contents as $content)
            <option @if(isset($content_id['subject_id']) == $content->id) selected @endif value="{{ $content->id }}">{{ $content->name }}</option>
        @endforeach
    </select>
</div>
