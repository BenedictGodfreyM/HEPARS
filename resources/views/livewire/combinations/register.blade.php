@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        border-color: #006fe6;
        color: #fff;
        padding: 0 10px;
        margin-top: .31rem;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $('.select2-subjects').select2().on('change', function (e) {
            @this.set('selectedSubjects', $(this).val());
        });
    })
</script>
@endpush

<div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-primary">
                <!-- form start -->
                <form wire:submit="registerCombination" action="" autocomplete="off">
                    <div class="card-body">
                        @if(session()->has('success'))
                        <livewire:shared.alert title="Success!" message="{{ session()->get('success') }}" css_class="alert-success" icon="fa-check" />
                        @endif
                        @if(session()->has('error'))
                        <livewire:shared.alert title="Error!" message="{{ session()->get('error') }}" css_class="alert-danger" icon="fa-ban" />
                        @endif
                        <div class="form-group">
                            <label for="inputCombinationName">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputCombinationName" placeholder="Enter Combination name (Eg. CBG, PCM, HGE, e.t.c )" wire:model="name">
                            @error('name')
                            <span id="inputCombinationName-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="inputCombinationSubjects">Subjects</label>
                            <select class="select2-subjects select2-hidden-accessible form-control @error('selectedSubjects') is-invalid @enderror" multiple="" data-placeholder="Select Subjects" id="inputCombinationSubjects" style="width: 100%;" wire:model="selectedSubjects">
                                @foreach ($subjects as $subject)
                                <option data-select2-id="{{ $subject->id }}" value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedSubjects')
                            <span id="inputCombinationSubjects-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>  
                    <div class="card-footer">
                        <a href="{{ route('combinations') }}" class="btn btn-danger float-left">Back</a>
                        <button type="submit" class="btn btn-success float-right">
                            <span wire:loading wire:target="registerCombination"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                            <span wire:loading.remove wire:target="registerCombination">Submit</span> 
                        </button>
                    </div>
                </form>
              </div>
        </div>
    </div>
</div>
