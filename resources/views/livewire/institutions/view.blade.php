<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $data->name }} ({{ $data->acronym }})</h3>
        </div>
        <div class="card-body">
            <dl>
                <dt>Type:</dt>
                <dd>{{ ucwords(strtolower($data->ownership)) }} {{ ucwords(strtolower($data->type)) }}</dd>

                @if($data->affiliatedTo)
                <dt>Affiliated To:</dt>
                <dd>{{ $data->affiliatedTo->name }} ({{ $data->affiliatedTo->acronym }})</dd>
                @endif

                <dt>Reputation:</dt>
                <dd>Rank (in Tanzania): {{ $data->rank }}; Accreditation Status: {{ ($data->accreditation_status) }}</dd>

                <dt>Programs Offered:</dt>
                <dd>{{ $data->programs->count() }} Undergraduate Programs</dd>

                <dt>Location:</dt>
                <dd>{{ $data->location }}</dd>

                <dd>
                    <a href="{{ $data->admission_portal_link }}" class="link-black text-sm" target="_blank">
                        <i class="fas fa-link mr-1"></i> Link to Admission Portal
                    </a>
                </dd>
            </dl>
        </div> 
        <div class="overlay" wire:loading.flex wire:target="loadData">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
    </div>
</div>
