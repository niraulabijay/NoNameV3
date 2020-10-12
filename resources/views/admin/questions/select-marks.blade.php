<div class="form-group">
    <label for="marks">Enter Marks:</label>
    <span class="errorForm" id="errorMarks">*</span>
    <select name="marks" id="marks" class="form-control">
        <option value="" selected disabled>Select Marks</option>
        @foreach($contents as $content)
            <option value="{{ $content->marks }}">{{ $content->marks }}</option>
        @endforeach
    </select>
    <span class="errorForm" id="errorMarks"></span>
</div>