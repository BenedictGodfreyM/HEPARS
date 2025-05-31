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
                <div class="form-group">
                    <label for="inputSubjectType">Type</label>
                    <div class="row border round mx-1 py-2">
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox-1" wire:model="is_compulsory">
                                <label for="customCheckbox-1" class="custom-control-label">Compulsory</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox-2" wire:model="is_additional">
                                <label for="customCheckbox-2" class="custom-control-label">Additional</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">
                    <span wire:loading wire:target="registerSubject"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                    <span wire:loading.remove wire:target="registerSubject">Submit</span>
                </button>
            </div>
        </form>
    </div>
</div>
