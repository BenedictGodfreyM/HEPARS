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
                        <div class="form-group">
                            <label class="pl-4" style="width: 100%;text-align: center;" wire:loading wire:target="addCombinationSubjectsToSelection">
                                <i class="fas fa-2x fa-spinner fa-spin"></i>
                            </label>
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
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Career Choice</label>
                            <select class="form-control @error('selectedCareer') is-invalid @enderror" wire:model="selectedCareer" required>
                                <option selected disabled value="">Select any Option</option>
                                @foreach ($fields as $field)
                                <optgroup label="{{ $field->name }}">
                                    @foreach ($field->careers as $career)
                                    <option value="{{ $career->id }}">{{ $career->name }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                            @error('selectedCareer')
                            <span id="inputSelectedCareer-Error" class="error invalid-feedback">{{ $message }}</span>
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
    @if($showRecommendations)
    <div class="modal fade show" id="modal-lg" style="display: block; padding-right: 15px;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">We recommend these programs...</h4>
                    <button type="button" wire:click="clearRecommendations" class="close" data-dismiss="modal" aria-label="Close">
                        <span wire:loading wire:target="clearRecommendations" aria-hidden="true">
                            <i class="fas fa-1x fa-sync-alt fa-spin"></i>
                        </span>
                        <span wire:loading.remove wire:target="clearRecommendations" aria-hidden="true">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(count($recommendations['BasedOnSelectedCareer']) > 0)
                    <h5>Based on your Career Choice</h5>
                    <div class="card-comments px-2 py-2">
                        @foreach($recommendations['BasedOnSelectedCareer'] as $key => $recomendation)
                        <div class="card-comment">
                            <div class="comment-text">
                                <span class="username">
                                    {{ $recomendation->name }}
                                    <span class="text-muted float-right">{{ $recomendation->duration }} Years ({{ ($recomendation->duration * 2) }} Semesters)</span>
                                </span>
                                Offered by: 
                                <cite title="{{ $recomendation->institution->name }}">
                                    {{ $recomendation->institution->name }} ({{ $recomendation->institution->acronym }}).<br>
                                    This is a {{ strtolower($recomendation->institution->ownership) }} {{ strtolower($recomendation->institution->type) }}, 
                                    located in {{ $recomendation->institution->location }}.
                                </cite>
                                <br>
                                Institution Status: 
                                <cite title="{{ $recomendation->institution->accreditation_status }}">{{ $recomendation->institution->accreditation_status }}</cite>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="row">
                        <div class="col-12 mt-3 text-center">
                            <p class="lead text-warning">
                                Sorry!. Based on your career choice, we couldn't find programs you qualify in.<br>
                                @if(count($recommendations['BasedOnRelatedCareers']) > 0)
                                    However, you qualify for other programs within the field of {{ $recommendations['CareerField'] }}.<br> 
                                    Check out the list below:
                                @else
                                    Try selecting a different career.
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif
                    @if(count($recommendations['BasedOnRelatedCareers']) > 0)
                    @if(count($recommendations['BasedOnSelectedCareer']) > 0)
                    <h5 class="mt-2">More from {{ $recommendations['CareerField'] }} Field</h5>
                    @endif
                    <div class="card-comments px-2 py-2">
                        @foreach($recommendations['BasedOnRelatedCareers'] as $key => $recomendation)
                        <div class="card-comment">
                            <div class="comment-text">
                                <span class="username">
                                    {{ $recomendation->name }}
                                    <span class="text-muted float-right">{{ $recomendation->duration }} Years ({{ ($recomendation->duration * 2) }} Semesters)</span>
                                </span>
                                Offered by: 
                                <cite title="{{ $recomendation->institution->name }}">
                                    {{ $recomendation->institution->name }} ({{ $recomendation->institution->acronym }}).<br>
                                    This is a {{ strtolower($recomendation->institution->ownership) }} {{ strtolower($recomendation->institution->type) }}, 
                                    located in {{ $recomendation->institution->location }}.
                                </cite>
                                <br>
                                Institution Status: 
                                <cite title="{{ $recomendation->institution->accreditation_status }}">{{ $recomendation->institution->accreditation_status }}</cite>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="printRecommendations" class="btn btn-default" data-dismiss="modal" disabled>
                        <span wire:loading wire:target="printRecommendations"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Processing...</span>
                        <span wire:loading.remove wire:target="printRecommendations"><i class="fas fa-print"></i> Print</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
