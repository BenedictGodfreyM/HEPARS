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
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-primary">
                <!-- form start -->
                <form wire:submit="registerCareer" action="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputCareerName">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputCareerName" placeholder="Enter Career name (Eg. Teacher)" wire:model="name">
                            @error('name')
                            <span id="inputCareerName-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>  
                    <div class="card-footer">
                        <a href="{{ route('fields.careers', ['field_id' => $fieldId]) }}" class="btn btn-danger float-left">Back</a>
                        <button type="submit" class="btn btn-success float-right">
                            <span wire:loading wire:target="registerCareer"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                            <span wire:loading.remove wire:target="registerCareer">Submit</span>
                        </button>
                    </div>
                </form>
              </div>
        </div>
    </div>
</div>
