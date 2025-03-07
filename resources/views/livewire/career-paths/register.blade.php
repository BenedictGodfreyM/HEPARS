<div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-primary">
                <!-- form start -->
                <form wire:submit="registerCareerPath" action="">
                    <div class="card-body">
                        @if(session()->has('success'))
                        <livewire:shared.alert title="Success!" message="{{ session()->get('success') }}" css_class="alert-success" icon="fa-check" />
                        @endif
                        @if(session()->has('error'))
                        <livewire:shared.alert title="Error!" message="{{ session()->get('error') }}" css_class="alert-danger" icon="fa-ban" />
                        @endif
                        <div class="form-group">
                            <label for="inputCareerPathName">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputCareerPathName" placeholder="Enter Career Path name (Eg. Teacher)" wire:model="name">
                            @error('name')
                            <span id="inputCareerPathName-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>  
                    <div class="card-footer">
                        <a href="{{ route('career_paths') }}" class="btn btn-danger float-left">Back</a>
                        <button type="submit" class="btn btn-success float-right">
                            <span wire:loading wire:target="registerCareerPath"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                            <span wire:loading.remove wire:target="registerCareerPath">Submit</span>
                        </button>
                    </div>
                </form>
              </div>
        </div>
    </div>
</div>
