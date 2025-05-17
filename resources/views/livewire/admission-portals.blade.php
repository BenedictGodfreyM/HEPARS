<div>
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">
                @if($data->count() > 10)
                <div class="input-group input-group-sm my-1" style="width: 110px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Items:</span>
                    </div>
                    <select class="form-control" wire:model.live="pageSize">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
                @endif
            </h3>

            <div class="card-tools">
                <div class="input-group input-group-sm my-1" style="width: 180px;">
                    <input type="search" wire:model.live="searchQuery" class="form-control float-right" placeholder="Search" autocomplete="off">

                    <div class="input-group-append">
                        <button type="button" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($data as $item)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-body pt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="lead">
                                            <b>{{ $item->name }}</b>
                                            <span class="badge bg-secondary">{{ $item->ownership }} {{ $item->type }}</span>
                                        </h2>
                                        <p class="text-muted text-sm">
                                            <a href="{{ $item->admission_portal_link }}" class="link-black text-sm" target="_blank"><i class="fas fa-link mr-1"></i> Admission Portal</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-body pt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="lead"><b>Sorry!!!</b></h2>
                                        <p class="text-muted text-sm">No data to display!!!.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="card-footer">
            {{ $data->links() }}
        </div>
        <div class="overlay" wire:loading.flex>
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
    </div>
</div>
