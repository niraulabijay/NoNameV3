<div class="form-group">
    <label>Select Chapter</label>
    <span class="errorForm" id="errorChapter">*</span>
    <select class="custom-select selectforchild" id="chapter" data-type="chapter" name="chapter_id">
        <option value="" selected disabled>Select Chapter</option>
        @foreach($contents as $content)
            <option value="{{ $content->id }}">{{ $content->name }}</option>
        @endforeach
    </select>
</div>
