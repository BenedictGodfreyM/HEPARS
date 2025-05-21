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
                            <label>Affiliated To</label>
                            <select id="inputInstitutionAffiliation" class="form-control @error('affiliation_id') is-invalid @enderror" wire:change="retrieveMotherInstitutionDetails($event.target.value)" wire:loading.attr="disabled" wire:model="affiliation_id">
                                <option selected="" value="">Select an Institution</option>
                                @forelse ($allMotherInstitutions as $institution)
                                <option value="{{ $institution['id'] }}">{{ $institution['name'] }} ({{ $institution['acronym'] }})</option>
                                @empty
                                <option value="">No Data Available</option>
                                @endforelse
                            </select>
                            @error('affiliation_id')
                            <span id="inputInstitutionAffiliation-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputInstitutionAcronym">Acronym</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('acronym') is-invalid @enderror" id="inputInstitutionAcronym" placeholder="Enter institution acronym (Eg. ARU)" wire:model="acronym">
                                <div class="input-group-append" wire:loading wire:target="retrieveMotherInstitutionDetails">
                                    <span class="input-group-text">
                                        <i class="fas fa-1x fa-spinner fa-spin py-1"></i>
                                    </span>
                                </div>
                                @error('acronym')
                                <span id="inputInstitutionAcronym-Error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <div class="input-group">
                                <select id="inputInstitutionType" class="form-control @error('type') is-invalid @enderror" wire:model="type">
                                    <option selected="">Select Institution Type</option>
                                    <option value="University">University</option>
                                    <option value="University College">University College</option>
                                    <option value="University Campus College">University Campus College</option>
                                    <option value="Non-University">Non-University</option>
                                </select>
                                <div class="input-group-append" wire:loading wire:target="retrieveMotherInstitutionDetails">
                                    <span class="input-group-text">
                                        <i class="fas fa-1x fa-spinner fa-spin py-1"></i>
                                    </span>
                                </div>
                                @error('type')
                                <span id="inputInstitutionType-Error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ownership</label>
                            <div class="input-group">
                                <select id="inputInstitutionOwnership" class="form-control @error('ownership') is-invalid @enderror" wire:loading.attr="disabled" wire:model="ownership">
                                    <option selected="">Select Institution Ownership</option>
                                    <option value="Private">Private</option>
                                    <option value="Public">Public</option>
                                </select>
                                <div class="input-group-append" wire:loading wire:target="retrieveMotherInstitutionDetails">
                                    <span class="input-group-text">
                                        <i class="fas fa-1x fa-spinner fa-spin py-1"></i>
                                    </span>
                                </div>
                                @error('ownership')
                                <span id="inputInstitutionOwnership-Error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputInstitutionRank">Rank</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('rank') is-invalid @enderror" id="inputInstitutionRank" placeholder="Enter institution's rank (Eg. 2)" wire:loading.attr="disabled" wire:model="rank">
                                <div class="input-group-append" wire:loading wire:target="retrieveMotherInstitutionDetails">
                                    <span class="input-group-text">
                                        <i class="fas fa-1x fa-spinner fa-spin py-1"></i>
                                    </span>
                                </div>
                                @error('rank')
                                <span id="inputInstitutionRank-Error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputInstitutionAccreditationStatus">Accreditation Status</label>
                            <div class="input-group">
                                <select class="form-control" wire:change="addAccreditationToSelection($event.target.value)" id="inputInstitutionAccreditationStatus" wire:loading.attr="disabled" wire:model="selectedOption">
                                    <option selected disabled value="">Select an Accreditation Status</option>
                                    @forelse ($availableAccreditations as $accreditation)
                                    <option value="{{ $accreditation['id'] }}">{{ $accreditation['status'] }}</option>
                                    @empty
                                    <option value="">No Data Available</option>
                                    @endforelse
                                </select>
                                <div class="input-group-append" wire:loading wire:target="retrieveMotherInstitutionDetails">
                                    <span class="input-group-text">
                                        <i class="fas fa-1x fa-spinner fa-spin py-1"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @if(count($selectedAccreditations) > 0)
                        @foreach($selectedAccreditations as $index => $AccreditationData)
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ $AccreditationData['status'] }}" required readonly>
                                <div class="input-group-append">
                                    <button type="button" wire:click="removeAccreditationFromSelection({{ $index }})" class="btn btn-danger">
                                        <i class="fa fa-times" aria-hidden="true" wire:loading.remove wire:target="removeAccreditationFromSelection({{ $index }})"></i>
                                        <i class="fas fa-1x fa-spinner fa-spin" aria-hidden="true" wire:loading wire:target="removeAccreditationFromSelection({{ $index }})"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="form-group">
                            <label class="pl-4" style="width: 100%;text-align: center;" wire:loading wire:target="addAccreditationToSelection">
                                <i class="fas fa-1x fa-spinner fa-spin"></i>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="inputInstitutionLocation">Location</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('location') is-invalid @enderror" id="inputInstitutionLocation" placeholder="Enter institution's geographical location (Eg. Dar es Salaam)" wire:loading.attr="disabled" wire:model="location">
                                <div class="input-group-append" wire:loading wire:target="retrieveMotherInstitutionDetails">
                                    <span class="input-group-text">
                                        <i class="fas fa-1x fa-spinner fa-spin py-1"></i>
                                    </span>
                                </div>
                                @error('location')
                                <span id="inputInstitutionLocation-Error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputInstitutionAdmissionPortalLink">Admission Portal Link</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('admission_portal_link') is-invalid @enderror" id="inputInstitutionAdmissionPortalLink" placeholder="Enter institution's admission portal link (Eg. https://www.domain.ac.tz)" wire:loading.attr="disabled" wire:model="admission_portal_link">
                                <div class="input-group-append" wire:loading wire:target="retrieveMotherInstitutionDetails">
                                    <span class="input-group-text">
                                        <i class="fas fa-1x fa-spinner fa-spin py-1"></i>
                                    </span>
                                </div>
                                @error('admission_portal_link')
                                <span id="inputInstitutionAdmissionPortalLink-Error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
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
