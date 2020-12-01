<div class="alert alert-{{ $type == 'error' ? 'danger' : $type }} {{ $dismissible ? 'alert-dismissible fade show' : '' }} mt-2">
    {{ $message }}
    @if($dismissible)
        <button class="close" data-dismiss="alert">&times;</button>
    @endif
</div>
