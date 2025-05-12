<div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Program Details</h3>
                </div>
                <div class="card-body">
                    <dl>
                        <dt>Duration:</dt>
                        <dd>{{ $data->duration }} Years ({{ ($data->duration * 2) }} Semesters)</dd>
                        
                        @if(count($data->entryRequirements) > 0)
                        <dt class="mt-3">Entry Requirements:</dt>
                        <dd>{{ format_entry_requirements($data->entryRequirements->first()) }}</dd>
                        @endif

                        @if(count($data->career_paths) > 0)
                        <dt class="mt-3">Potential Career Paths:</dt>
                        <dd>
                            <ul>
                                @foreach($data->career_paths as $key => $career)
                                <li>{{ $career->name }}</li>
                                @endforeach
                            </ul>
                        </dd>
                        @endif
                    </dl>
                </div> 
                <div class="card-footer">
                    <a href="{{ route('institutions.programs', ['institution_id' => $institutionID]) }}" class="btn btn-danger float-left">Back</a>
                    <a href="{{ route('institutions.programs.edit', ['institution_id' => $institutionID, 'program_id' => $programID]) }}" class="btn btn-info float-right">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
