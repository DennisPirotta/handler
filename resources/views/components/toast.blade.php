@props(['icon','message'])
<div class="toast show fade toast-info" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-color="info" data-mdb-autohide="false">
    <div class="toast-header toast-info">
        <i class="fas {{ $icon }} fa-lg me-2"></i>
        <strong class="me-auto">Impostazioni</strong>
        <small>Adesso</small>
        <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">{{ $message }}</div>
</div>