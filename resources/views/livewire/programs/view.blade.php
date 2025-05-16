<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $data->name }}</h3>
        </div>
        <div class="card-body">
            <dl>
                <dt>Duration:</dt>
                <dd>{{ $data->duration }} Years ({{ ($data->duration * 2) }} Semesters)</dd>
                
                @if(count($data->entryRequirements) > 0)
                <dt class="mt-3">Entry Requirements:</dt>
                <dd>{{ format_entry_requirements($data->entryRequirements->first()) }}</dd>
                @endif

                @if(count($data->careers) > 0)
                <dt class="mt-3">Potential Careers:</dt>
                <dd>
                    <ul>
                        @foreach($data->careers as $key => $career)
                        <li>{{ $career->name }}</li>
                        @endforeach
                    </ul>
                </dd>
                @endif
            </dl>
        </div> 
        <div class="overlay" wire:loading.flex wire:target="loadData">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
    </div>
</div>
