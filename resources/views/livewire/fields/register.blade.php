@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('flash-alert', (event) => {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            Toast.fire({
                icon: `${event.type}`,
                title: `${event.title}: ${event.message}`
            });
        });
    });
</script>
@endpush

<div>
    <div class="card card-primary">
        <!-- form start -->
        <form wire:submit="registerField" action="" autocomplete="off">
            <div class="card-body">
                <div class="form-group">
                    <label for="inputFieldName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputFieldName" placeholder="Enter Field name (Eg. Engineering, Medicine, e.t.c )" wire:model="name">
                    @error('name')
                    <span id="inputFieldName-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>  
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">
                    <span wire:loading wire:target="registerField"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                    <span wire:loading.remove wire:target="registerField">Submit</span> 
                </button>
            </div>
        </form>
    </div>
</div>
