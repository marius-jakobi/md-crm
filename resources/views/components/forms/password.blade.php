<div class="form-group">
    <label>{{ $caption }}</label>
    <input type="password" name="password" class="form-control" required maxlength="{{ $maxLength }}" />
    @error('password')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
