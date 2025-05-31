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
        <form wire:submit="registerCombination" action="" autocomplete="off">
            <div class="card-body">
                <div class="form-group">
                    <label for="inputCombinationName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputCombinationName" placeholder="Enter Combination name (Eg. CBG, PCM, HGE, e.t.c )" wire:model="name">
                    @error('name')
                    <span id="inputCombinationName-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select id="inputCombinationCategory" class="form-control @error('category') is-invalid @enderror" wire:model="category">
                        <option selected value="">Select Combination Category</option>
                        <option value="Natural Science">Natural Science Combination</option>
                        <option value="Arts">Arts Combination</option>
                    </select>
                    @error('category')
                    <span id="inputCombinationCategory-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputCombinationSubjects">Subjects</label>
                    <select class="form-control" wire:change="addSubjectToSelection($event.target.value)" id="inputCombinationSubjects" wire:model="selectedOption">
                        <option selected disabled value="">Select a Subject</option>
                        @forelse ($availableSubjects as $subject)
                        <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                        @empty
                        <option value="">No Data Available</option>
                        @endforelse
                    </select>
                </div>
                @if(count($selectedSubjects) > 0)
                @foreach($selectedSubjects as $index => $subjectData)
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ $subjectData['name'] }}" required readonly>
                        <div class="input-group-append">
                            <button type="button" wire:click="removeSubjectFromSelection({{ $index }})" class="btn btn-danger">
                                <i class="fa fa-times" aria-hidden="true" wire:loading.remove wire:target="removeSubjectFromSelection({{ $index }})"></i>
                                <i class="fas fa-1x fa-spinner fa-spin" aria-hidden="true" wire:loading wire:target="removeSubjectFromSelection({{ $index }})"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                <div class="form-group">
                    <label class="pl-4" style="width: 100%;text-align: center;" wire:loading wire:target="addSubjectToSelection">
                        <i class="fas fa-1x fa-spinner fa-spin"></i>
                    </label>
                </div>
            </div>  
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">
                    <span wire:loading wire:target="registerCombination"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                    <span wire:loading.remove wire:target="registerCombination">Submit</span> 
                </button>
            </div>
        </form>
    </div>
</div>
