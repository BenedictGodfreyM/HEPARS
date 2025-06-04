<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $data->name }}</h3>
        </div>
        <div class="card-body">
            <dl>
                {{-- <dt>Level of Autonomy:</dt>
                <dd>{{ $data->autonomy }}</dd>
                
                <dt class="mt-3">Description:</dt>
                <dd>{{ $data->description }}</dd> --}}
                
            </dl>
        </div> 
        <div class="overlay" wire:loading.flex wire:target="loadData">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
    </div>
</div>
