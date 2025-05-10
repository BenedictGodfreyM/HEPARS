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
        $('.select2-career-paths').select2().on('change', function (e) {
            @this.set('selectedCareerPaths', $(this).val());
        });
    })
</script>
@endpush

<div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-primary">
                <!-- form start -->
                <form wire:submit="registerProgram" action="">
                    <div class="card-body">
                        @if(session()->has('success'))
                        <livewire:shared.alert title="Success!" message="{{ session()->get('success') }}" css_class="alert-success" icon="fa-check" />
                        @endif
                        @if(session()->has('error'))
                        <livewire:shared.alert title="Error!" message="{{ session()->get('error') }}" css_class="alert-danger" icon="fa-ban" />
                        @endif
                        <div class="form-group">
                            <label for="inputProgramName">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputProgramName" placeholder="Enter Program name (Eg. Bachelor of Arts with Education )" wire:model="name">
                            @error('name')
                            <span id="inputProgramName-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputProgramDuration">Duration (Number of Years)</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" id="inputProgramDuration" placeholder="Enter Program duration (Eg. 3)" wire:model="duration">
                            @error('duration')
                            <span id="inputProgramDuration-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="inputProgramCareerPath">Career Paths</label>
                            <select class="select2-career-paths select2-hidden-accessible form-control @error('selectedCareerPaths') is-invalid @enderror" multiple="" data-placeholder="Select Career Paths" id="inputProgramCareerPath" style="width: 100%;" wire:model="selectedCareerPaths">
                                @foreach ($career_paths as $career_path)
                                <option data-select2-id="{{ $career_path->id }}" value="{{ $career_path->id }}">{{ $career_path->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedCareerPaths')
                            <span id="inputProgramCareerPath-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <h5 class="mt-2">Entry Requirements</h5>
                        <div class="form-group">
                            <label for="inputMinTotalPoints">Minimum Total Points</label>
                            <input type="number" class="form-control @error('min_total_points') is-invalid @enderror" id="inputMinTotalPoints" placeholder="Enter minimum total points required for the program (Eg. 4)" wire:model="min_total_points">
                            @error('min_total_points')
                            <span id="inputMinTotalPoints-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputRequiredSubjectCount">Required Subject Count</label>
                            <input type="number" class="form-control @error('required_subjects_count') is-invalid @enderror" id="inputRequiredSubjectCount" placeholder="Enter the number of required subjects (Eg. 2)" wire:model="required_subjects_count">
                            @error('required_subjects_count')
                            <span id="inputRequiredSubjectCount-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Minimum Subject Score</label>
                            <select class="form-control" wire:change="addSubjectToSelection($event.target.value)" wire:model="selectedOption">
                                <option selected value="">Select a Subject</option>
                                @forelse ($availableSubjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @empty
                                <option value="">No Data Available</option>
                                @endforelse
                            </select>
                        </div>
                        @if(count($selectedSubjects) > 0)
                        @foreach($selectedSubjects as $index => $subjectData)
                        <div class="form-group">
                            <div class="row border rounded mx-1 py-2">
                                <div class="col-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ $subjectData['subject']['name'] }}:</span>
                                        </div>
                                        <select class="form-control" wire:change="updateSelectedSubject({{ $index }}, $event.target.value)" required>
                                            <option value="" selected>--Select Grade--</option>
                                            @foreach($availableGrades as $grade)
                                                <option value="{{ $grade }}">{{ $grade }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" wire:click="removeSubjectFromSelection({{ $index }})" class="btn btn-danger">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio-1-{{ $index }}-{{ $subjectData['subject']['id'] }}" wire:model="selectedSubjects.{{ $index }}.type" value="required">
                                                <label for="customRadio-1-{{ $index }}-{{ $subjectData['subject']['id'] }}" class="custom-control-label">Required</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio-2-{{ $index }}-{{ $subjectData['subject']['id'] }}" wire:model="selectedSubjects.{{ $index }}.type" value="necessary">
                                                <label for="customRadio-2-{{ $index }}-{{ $subjectData['subject']['id'] }}" class="custom-control-label">Necessary</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio-3-{{ $index }}-{{ $subjectData['subject']['id'] }}" wire:model="selectedSubjects.{{ $index }}.type" value="optional">
                                                <label for="customRadio-3-{{ $index }}-{{ $subjectData['subject']['id'] }}" class="custom-control-label">Optional</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>  
                    <div class="card-footer">
                        <a href="{{ route('institutions.programs', ['institution_id' => $institutionId]) }}" class="btn btn-danger float-left">Back</a>
                        <button type="submit" class="btn btn-success float-right">
                            <span wire:loading wire:target="registerProgram"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                            <span wire:loading.remove wire:target="registerProgram">Submit</span>
                        </button>
                    </div>
                </form>
              </div>
        </div>
    </div>
</div>
