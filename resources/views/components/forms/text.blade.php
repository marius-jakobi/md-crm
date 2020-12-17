<div class="form-group">
    <label>{{ $caption }}</label>
    @if($attributes['value'])
        <input type="text" name="{{ $name }}" maxlength="128" class="form-control" {{ $attributes }} value="{!! $attributes['value'] !!}" />
    @elseif(old($name))
        <input type="text" name="{{ $name }}" maxlength="128" class="form-control" {{ $attributes }}value="{{ old($name) }}" />
    @else
        <input type="text" name="{{ $name }}" maxlength="128" class="form-control" {{ $attributes }} />
    @endif
    @error($name)
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
