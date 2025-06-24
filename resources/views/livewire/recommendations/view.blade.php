<div>
    <h4 class="text-center">ACSEE Results</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data->acsee_results as $key => $item)
            <tr>
                <td>{{ $item['subject'] }}</td>
                <td>{{ $item['grade'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h4 class="mt-4 text-center">Recommendations</h4>
    @if(count($data->programs['BasedOnselectedCareerField']) > 0)
    @if(count($data->programs['BasedOnOtherCareerFields']) > 0)
    <h5>Based on your Career Choice ({{ $data->career_choice }})</h5>
    @endif
    <div class="card-comments px-2 py-2">
        @foreach($data->programs['BasedOnselectedCareerField'] as $key => $recomendation)
        <div class="card-comment">
            <div class="comment-text">
                <span class="username">
                    {{ $recomendation['name'] }}
                    @if($recomendation['competition_scale'] === "High Competition")
                    <span class="badge bg-danger">High Competition</span>
                    @endif
                    <span class="text-muted float-right">{{ $recomendation['duration'] }} Years ({{ ($recomendation['duration'] * 2) }} Semesters)</span>
                </span>
                Offered by: 
                <cite title="{{ $recomendation['institution']['name'] }}">
                    {{ $recomendation['institution']['name'] }} ({{ $recomendation['institution']['acronym'] }}).<br>
                    This is a {{ strtolower($recomendation['institution']['ownership']) }} {{ strtolower($recomendation['institution']['type']) }}, 
                    located in {{ $recomendation['institution']['location'] }}.
                </cite>
                <br>
                {{-- Institution Status:  --}}
                {{-- <cite title="{{ $recomendation['institution']['name'] }}">{{ $recomendation['institution']['accreditation_status'] }}</cite> --}}
                @if(isset($recomendation['institution']['affiliatedTo']) && $recomendation['institution']['affiliatedTo'])
                <br>
                Affiliated To:
                <cite title="{{ $recomendation['institution']['name'] }}">{{ $recomendation['institution']['affiliatedTo']['name'] }} ({{ $recomendation['institution']['affiliatedTo']['acronym'] }})</cite>
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
                Sorry!. We couldn't find programs you qualify in, based on your career choice <span style="font-style: italic;">({{ $data->career_choice }})</span>.<br>
                @if(count($data->programs['BasedOnOtherCareerFields']) > 0)
                    However, you qualify for programs from other fields.<br> 
                    Check out the list below:
                @else
                    Try selecting a different career.
                @endif
            </p>
        </div>
    </div>
    @endif
    @if(count($data->programs['BasedOnOtherCareerFields']) > 0)
    @if(count($data->programs['BasedOnselectedCareerField']) > 0)
    <h5 class="mt-2">Programs from other career fields</h5>
    @endif
    <div class="card-comments px-2 py-2">
        @foreach($data->programs['BasedOnOtherCareerFields'] as $key => $recomendation)
        <div class="card-comment">
            <div class="comment-text">
                <span class="username">
                    {{ $recomendation['name'] }} 
                    @if($recomendation['competition_scale'] === "High Competition")
                    <span class="badge bg-danger">High Competition</span>
                    @endif
                    <span class="text-muted float-right">{{ $recomendation['duration'] }} Years ({{ ($recomendation['duration'] * 2) }} Semesters)</span>
                </span>
                Offered by: 
                <cite title="{{ $recomendation['institution']['name'] }}">
                    {{ $recomendation['institution']['name'] }} ({{ $recomendation['institution']['acronym'] }}).<br>
                    This is a {{ strtolower($recomendation['institution']['ownership']) }} {{ strtolower($recomendation['institution']['type']) }}, 
                    located in {{ $recomendation['institution']['location'] }}.
                </cite>
                <br>
                {{-- Institution Status:  --}}
                {{-- <cite title="{{ $recomendation['institution']['name'] }}">{{ $recomendation['institution']['accreditation_status'] }}</cite> --}}
                @if(isset($recomendation['institution']['affiliatedTo']) && $recomendation['institution']['affiliatedTo'])
                <br>
                Affiliated To:
                <cite title="{{ $recomendation['institution']['name'] }}">{{ $recomendation['institution']['affiliatedTo']['name'] }} ({{ $recomendation['institution']['affiliatedTo']['acronym'] }})</cite>
                @endif
                <br>
                <cite title="Link to Admission Portal">
                    <a href="{{ $recomendation['institution']['admission_portal_link'] }}" class="link-black text-sm" target="_blank">
                        <i class="fas fa-link mr-1"></i> Link to Admission Portal
                    </a>
                </cite>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
