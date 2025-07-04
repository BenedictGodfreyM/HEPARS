@push("styles")
<style>
    .custom-spinner {
        width: 40px;
        height: 40px;
        border: 5px solid rgba(0,0,0,.1);
        border-radius: 50%;
        border-top-color: #3498db;
        animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
@endpush

<div>
    <div class="callout callout-info">
        <h5>Hello!</h5> 
        <p>
            Welcome to the Higher Education Program Recommendation System. 
            We look forward to helping you find the appropriate undergraduate program that best serves your interests. 
            Just provide your high school results together with your career choice and we'll recommend programs that suit you.
        </p>
    </div>
    @auth
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
                        <div class="row col-12" wire:loading wire:target="addCombinationSubjectsToSelection">
                            <div class="mx-auto my-auto custom-spinner"></div>
                        </div>
                        @if(count($selectedSubjects) > 0)
                        @foreach($selectedSubjects as $index => $subjectData)
                        <div class="form-group" wire:key="{{ $index }}" wire:loading.remove wire:target="addCombinationSubjectsToSelection">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $subjectData['subject']['name'] }}:</span>
                                </div>
                                <select class="form-control" wire:model="selectedSubjects.{{ $index }}.grade" required>
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
                            <select class="form-control @error('selectedCareerField') is-invalid @enderror" wire:model="selectedCareerField" @if(count($selectedSubjects) <= 0) disabled @endif required>
                                <option selected disabled value="">Select any Option</option>
                                @foreach ($careerFields as $field)
                                <option value="{{ $field->id }}">{{ $field->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedCareerField')
                            <span id="inputSelectedCareerField-Error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 mx-auto">
                        <button type="submit" class="btn btn-success float-right shadow-lg">
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
                    @if(count($recommendations['BasedOnselectedCareerField']) > 0)
                    @if(count($recommendations['BasedOnOtherCareerFields']) > 0)
                    <h5>Based on your Career Choice ({{ $recommendations['CareerField'] }})</h5>
                    @endif
                    <div class="card-comments px-2 py-2">
                        @foreach($recommendations['BasedOnselectedCareerField'] as $key => $recomendation)
                        <div class="card-comment">
                            <div class="comment-text">
                                <span class="username">
                                    {{ $recomendation->name }}
                                    @if($recomendation->competition_scale === "High Competition")
                                    <span class="badge bg-danger">High Competition</span>
                                    @endif
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
                                <cite title="{{ $recomendation->institution->name }}">{{ $recomendation->institution->accreditation_status }}</cite>
                                @if($recomendation->institution->affiliatedTo)
                                <br>
                                Affiliated To:
                                <cite title="{{ $recomendation->institution->name }}">{{ $recomendation->institution->affiliatedTo->name }} ({{ $recomendation->institution->affiliatedTo->acronym }})</cite>
                                @endif
                                <br>
                                <cite title="Link to Admission Portal">
                                    <a href="{{ $recomendation->institution->admission_portal_link }}" class="link-black text-sm" target="_blank">
                                        <i class="fas fa-link mr-1"></i> Link to Admission Portal
                                    </a>
                                </cite>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="row">
                        <div class="col-12 mt-3 text-center">
                            <p class="lead text-warning">
                                Sorry!. We couldn't find programs you qualify in, based on your career choice <span style="font-style: italic;">({{ $recommendations['CareerField'] }})</span>.<br>
                                @if(count($recommendations['BasedOnOtherCareerFields']) > 0)
                                    However, you qualify for programs from other fields.<br> 
                                    Check out the list below:
                                @else
                                    Try selecting a different career.
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif
                    @if(count($recommendations['BasedOnOtherCareerFields']) > 0)
                    @if(count($recommendations['BasedOnselectedCareerField']) > 0)
                    <h5 class="mt-2">Programs from other career fields</h5>
                    @endif
                    <div class="card-comments px-2 py-2">
                        @foreach($recommendations['BasedOnOtherCareerFields'] as $key => $recomendation)
                        <div class="card-comment">
                            <div class="comment-text">
                                <span class="username">
                                    {{ $recomendation->name }} 
                                    @if($recomendation->competition_scale === "High Competition")
                                    <span class="badge bg-danger">High Competition</span>
                                    @endif
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
                                <cite title="{{ $recomendation->institution->name }}">{{ $recomendation->institution->accreditation_status }}</cite>
                                @if($recomendation->institution->affiliatedTo)
                                <br>
                                Affiliated To:
                                <cite title="{{ $recomendation->institution->name }}">{{ $recomendation->institution->affiliatedTo->name }} ({{ $recomendation->institution->affiliatedTo->acronym }})</cite>
                                @endif
                                <br>
                                <cite title="Link to Admission Portal">
                                    <a href="{{ $recomendation->institution->admission_portal_link }}" class="link-black text-sm" target="_blank">
                                        <i class="fas fa-link mr-1"></i> Link to Admission Portal
                                    </a>
                                </cite>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="generatePDF" class="btn btn-default" data-dismiss="modal">
                        <span wire:loading wire:target="generatePDF"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Processing...</span>
                        <span wire:loading.remove wire:target="generatePDF"><i class="fas fa-file-pdf"></i> Export as PDF</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @else
    <div class="row">
        <div class="col-12 mt-3 text-center">
            <a href="{{ route('login') }}" class="lead text-primary">Log in to continue...</a>
        </div>
    </div>
    @endif
</div>
