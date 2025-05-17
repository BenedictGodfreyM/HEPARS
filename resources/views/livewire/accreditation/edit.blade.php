<div>
    <div class="card card-primary">
        <!-- form start -->
        <form wire:submit="updateAccreditationDetails" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="inputAccreditationStatus">Status</label>
                    <input type="text" class="form-control @error('status') is-invalid @enderror" id="inputAccreditationStatus" placeholder="Enter Accreditation status (Eg. Accredited, Chartered, Provisional Licence, e.t.c )" wire:model="status">
                    @error('status')
                    <span id="inputAccreditationStatus-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputAccreditationRating">Rating</label>
                    <input type="number" class="form-control @error('rating') is-invalid @enderror" id="inputAccreditationRating" placeholder="Enter Accreditation rating (Eg. 4)" wire:model="rating">
                    @error('rating')
                    <span id="inputAccreditationRating-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputAccreditationDescription">Description</label>
                    <textarea id="inputAccreditationDescription" class="form-control @error('description') is-invalid @enderror" placeholder="Enter the description of Accreditation status" wire:model="description"></textarea>
                    @error('description')
                    <span id="inputAccreditationDescription-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>  
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">
                    <span wire:loading wire:target="updateAccreditationDetails"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                    <span wire:loading.remove wire:target="updateAccreditationDetails">Submit</span> 
                </button>
            </div>
        </form>
    </div>
</div>
