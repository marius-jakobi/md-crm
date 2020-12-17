<div class="form-group">
    <label>{{ $caption }}</label>
    <input type="email" name="email" class="form-control" required value="{{ old('email') ?? '' }}" />
    @error('email')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
