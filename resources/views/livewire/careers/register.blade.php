<div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-primary">
                <!-- form start -->
                <form wire:submit="registerCareer" action="">
                    <div class="card-body">
                        @if(session()->has('success'))
                        <livewire:shared.alert title="Success!" message="{{ session()->get('success') }}" css_class="alert-success" icon="fa-check" />
                        @endif
                        @if(session()->has('error'))
                        <livewire:shared.alert title="Error!" message="{{ session()->get('error') }}" css_class="alert-danger" icon="fa-ban" />
                        @endif
                        <div class="form-group">
                            <label for="inputCareerName">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputCareerName" placeholder="Enter Career name (Eg. Teacher)" wire:model="name">
                            @error('name')
                            <span id="inputCareerName-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>  
                    <div class="card-footer">
                        <a href="{{ route('disciplines.careers', ['discipline_id' => $disciplineId]) }}" class="btn btn-danger float-left">Back</a>
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
