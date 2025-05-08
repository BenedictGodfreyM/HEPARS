<div>
    <div class="callout callout-info">
        <h5>Hello!</h5>
        <p>
            Welcome to the Higher Education Program Recommendation System. 
            We look forward to helping you find the appropriate undergraduate program that best serves your interests. 
            Just provide your high school results together with your career choice and we'll recommend programs that suit you.
        </p>
    </div>
    <div class="card card-primary card-outline">
        @if(session()->has('no_recommenadations'))
        <livewire:shared.alert title="Sorry!!!" message="{{ session()->get('no_recommenadations') }}" css_class="alert-warning" icon="fa-circle" />
        @endif
        <div class="card-body">
            <form wire:submit="getRecommendations" action="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>High School Results</label>
                            <select class="form-control @error('selectedSubjects') is-invalid @enderror" wire:change="addCombinationSubjectsToSelection($event.target.value)" wire:model="selectedOption">
                                <option selected disabled value="">Select a Combination</option>
                                @forelse ($availableCombinations as $combination)
                                <option value="{{ $combination->id }}">{{ $combination->name }}</option>
                                @empty
                                <option value="">No Data Available</option>
                                @endforelse
                            </select>
                            @error('selectedSubjects')
                            <span id="inputSelectedSubjects-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" wire:loading wire:target="addCombinationSubjectsToSelection">
                            <label class="pl-4 text-md">Loading subjects...</label>
                        </div>
                        @if(count($selectedSubjects) > 0)
                        @foreach($selectedSubjects as $index => $subjectData)
                        <div class="form-group" wire:loading.remove wire:target="addCombinationSubjectsToSelection">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $subjectData['subject']['name'] }}:</span>
                                </div>
                                <select class="form-control" wire:change="updateSelectedSubject({{ $index }}, $event.target.value)" required>
                                    <option value="" disabled selected>--Select Grade--</option>
                                    @foreach($availableGrades as $grade)
                                        <option value="{{ $grade }}">{{ $grade }}</option>
                                    @endforeach
                                </select>
                                {{-- <div class="input-group-append">
                                    <button type="button" wire:click="removeSubjectFromSelection({{ $index }})" class="btn btn-danger">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Career Choice</label>
                            <select class="form-control @error('selectedCareerPath') is-invalid @enderror" wire:model="selectedCareerPath" required>
                                <option selected disabled value="">Select any Option</option>
                                @foreach ($career_paths as $career_path)
                                <option value="{{ $career_path->id }}">{{ $career_path->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedCareerPath')
                            <span id="inputSelectedCareerPath-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 mx-auto">
                        <button type="submit" class="btn btn-success float-right">
                            <span wire:loading wire:target="getRecommendations"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Processing...</span>
                            <span wire:loading.remove wire:target="getRecommendations">Request Recommendations</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(count($recommendations) > 0)
    <div class="modal fade show" id="modal-lg" style="display: block; padding-right: 15px;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">We recommend these programs...</h4>
                    <button type="button" wire:click="clearRecommendations" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:loading wire:target="clearRecommendations" aria-hidden="true"><i class="fas fa-1x fa-sync-alt fa-spin"></i></span>
                    <span wire:loading.remove wire:target="clearRecommendations" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body card-comments">
                    @foreach($recommendations as $key => $recomendation)
                    <div class="card-comment">
                        <div class="comment-text">
                          <span class="username">
                            {{ $recomendation->name }}
                            <span class="text-muted float-right">{{ $recomendation->duration }} Years ({{ ($recomendation->duration * 2) }} Semesters)</span>
                          </span>
                          Offered by <cite title="{{ $recomendation->institution->name }}">{{ $recomendation->institution->name }}</cite>.
                        </div>
                    </div>
                    @endforeach
                </div>
                {{-- <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="clearRecommendations" class="btn btn-default" data-dismiss="modal">
                        <span wire:loading wire:target="clearRecommendations"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Exiting...</span>
                        <span wire:loading.remove wire:target="clearRecommendations">Close</span>
                    </button>
                </div> --}}
            </div>
        </div>
    </div>
    @endif
</div>
