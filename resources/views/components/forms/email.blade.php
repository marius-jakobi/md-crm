<div class="form-group">
    <label>{{ $caption }}</label>
    <input type="email" name="email" class="form-control" required maxlength="{{ $maxLength }}"
           @if(old('email')) value="{{ old('email') }}"@endif />
    @error('email')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
