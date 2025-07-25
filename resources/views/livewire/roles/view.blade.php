<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $data->name }}</h3>
        </div>
        <div class="card-body">
            <dl>                
                <dt>Permissions:</dt>
                <dd>Assigned {{ $data->permissions->count() }} permission(s)</dd>

                <dt class="mt-3">Created At:</dt>
                <dd>{{ $data->created_at }}</dd>

                <dt>Updated At:</dt>
                <dd>{{ $data->updated_at }}</dd>                
            </dl>
        </div> 
        <div class="overlay" wire:loading.flex wire:target="loadData">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
    </div>
</div>
