<div class="alert alert-{{ $type == 'error' ? 'danger' : $type }} {{ $dismissible ? 'alert-dismissible fade show' : '' }}">
    {{ $message }}
    @if($dismissible)
        <button class="close" data-dismiss="alert">&times;</button>
    @endif
</div>
