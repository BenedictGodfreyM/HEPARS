<div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-primary">
                <!-- form start -->
                <form wire:submit="updateFieldDetails" action="">
                    <div class="card-body">
                        @if(session()->has('success'))
                        <livewire:shared.alert title="Success!" message="{{ session()->get('success') }}" css_class="alert-success" icon="fa-check" />
                        @endif
                        @if(session()->has('error'))
                        <livewire:shared.alert title="Error!" message="{{ session()->get('error') }}" css_class="alert-danger" icon="fa-ban" />
                        @endif
                        <div class="form-group">
                            <label for="inputFieldName">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputFieldName" placeholder="Enter Field name (Eg. Engineering, Medicine, e.t.c )" wire:model="name">
                            @error('name')
                            <span id="inputFieldName-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>  
                    <div class="card-footer">
                        <a href="{{ route('fields') }}" class="btn btn-danger float-left">Back</a>
                        <button type="submit" class="btn btn-success float-right">
                            <span wire:loading wire:target="updateFieldDetails"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                            <span wire:loading.remove wire:target="updateFieldDetails">Submit</span> 
                        </button>
                    </div>
                </form>
              </div>
        </div>
    </div>
</div>
