<div class="form-group">
    <label>{{ $caption }}</label>
    <input type="text" name="{{ $name }}" class="form-control" required maxlength="{{ $maxLength }}"
           @if(old($name)) value="{{ old($name) }}"@endif />
    @error($name)
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
