<div class="form-group">
    <label>{{ $caption }}</label>
    <textarea rows="{{ $rows }}" name="{{ $name }}" class="form-control">{{ old($name) ?? '' }}</textarea>
    @error($name)
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
