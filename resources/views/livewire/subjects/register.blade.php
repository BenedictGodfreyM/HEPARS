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
                <form wire:submit="registerSubject" action="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputSubjectName">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputSubjectName" placeholder="Enter Subject name (Eg. Physics)" wire:model="name">
                            @error('name')
                            <span id="inputSubjectName-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputSubjectCode">Code</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="inputSubjectCode" placeholder="Enter Subject code (Eg. PHY)" wire:model="code">
                            @error('code')
                            <span id="inputSubjectCode-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>  
                    <div class="card-footer">
                        <a href="{{ route('subjects') }}" class="btn btn-danger float-left">Back</a>
                        <button type="submit" class="btn btn-success float-right">
                            <span wire:loading wire:target="registerSubject"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                            <span wire:loading.remove wire:target="registerSubject">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
