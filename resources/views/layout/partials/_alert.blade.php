<div class="container">
    <div class="alert alert-{{ session()->get('flash_message_type') ?? 'success' }} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session()->get('flash_message') }}
    </div>
</div>
