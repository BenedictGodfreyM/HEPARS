<div>
    <div class="card card-primary">
        <!-- form start -->
        <form wire:submit="updateCareer" action="">
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
                <button type="submit" class="btn btn-success float-right">
                    <span wire:loading wire:target="updateCareer"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                    <span wire:loading.remove wire:target="updateCareer">Submit</span>
                </button>
            </div>
        </form>
    </div>
</div>
