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
                <form wire:submit="registerInstitution" action="">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputInstitutionName">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputInstitutionName" placeholder="Enter institution name (Eg. Ardhi University)" wire:model="name">
                            @error('name')
                            <span id="inputInstitutionName-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputInstitutionAcronym">Acronym</label>
                            <input type="text" class="form-control @error('acronym') is-invalid @enderror" id="inputInstitutionAcronym" placeholder="Enter institution acronym (Eg. ARU)" wire:model="acronym">
                            @error('acronym')
                            <span id="inputInstitutionAcronym-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select id="inputInstitutionType" class="form-control @error('type') is-invalid @enderror" wire:model="type">
                                <option selected="">Select Institution Type</option>
                                <option value="University">University</option>
                                <option value="University College">University College</option>
                                <option value="University Campus College">University Campus College</option>
                                <option value="Non-University">Non-University</option>
                            </select>
                            @error('type')
                            <span id="inputInstitutionType-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ownership</label>
                            <select id="inputInstitutionOwnership" class="form-control @error('ownership') is-invalid @enderror" wire:model="ownership">
                                <option selected="">Select Institution Ownership</option>
                                <option value="Private">Private</option>
                                <option value="Public">Public</option>
                            </select>
                            @error('ownership')
                            <span id="inputInstitutionOwnership-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputInstitutionCode">Code</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="inputInstitutionCode" placeholder="Enter institution's TCU code (Eg. AR)" wire:model="code">
                            @error('code')
                            <span id="inputInstitutionCode-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputInstitutionLocation">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="inputInstitutionLocation" placeholder="Enter institution's geographical location (Eg. Dar es Salaam)" wire:model="location">
                            @error('location')
                            <span id="inputInstitutionLocation-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputInstitutionAdmissionPortalLink">Admission Portal Link</label>
                            <input type="text" class="form-control @error('admission_portal_link') is-invalid @enderror" id="inputInstitutionAdmissionPortalLink" placeholder="Enter institution's admission portal link (Eg. https://www.domain.ac.tz)" wire:model="admission_portal_link">
                            @error('admission_portal_link')
                            <span id="inputInstitutionAdmissionPortalLink-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>  
                    <div class="card-footer">
                        <a href="{{ route('institutions') }}" class="btn btn-danger float-left">Back</a>
                        <button type="submit" class="btn btn-success float-right">
                            <span wire:loading wire:target="registerInstitution"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                            <span wire:loading.remove wire:target="registerInstitution">Submit</span>
                        </button>
                    </div>
                </form>
              </div>
        </div>
    </div>
</div>
