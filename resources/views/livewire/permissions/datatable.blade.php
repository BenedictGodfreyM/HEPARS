@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('flash-alert', (event) => {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            Toast.fire({
                icon: `${event.type}`,
                title: `${event.title}: ${event.message}`
            });
        });
    });
</script>
@endpush

<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">System Permissions</h3>
                </div>
                <div class="card-body">
                    @permission('view.permissions')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <div class="input-group input-group-sm my-1" style="width: 150px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Page Size:</span>
                                    </div>
                                    <select class="form-control" wire:model.live="pageSize">
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>
                            </h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm my-1" style="width: 150px;">
                                    <input type="search" wire:model.live="searchQuery" class="form-control float-right" placeholder="Search" autocomplete="off">

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        @foreach ($columns as $column)
                                            <th wire:click="sortBy('{{ $column }}')" style="cursor: pointer;">
                                                {{ ucfirst($column) }}
                                                @if ($sortField === $column)
                                                    @if ($sortDirection === 'asc')
                                                        <i class="fas fa-sort-up"></i>
                                                    @else
                                                        <i class="fas fa-sort-down"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort"></i>
                                                @endif
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @forelse ($data as $item)
                                            <tr wire:key="{{ $item->id }}">
                                                @foreach ($columns as $column)
                                                    <td>{{ $item->$column }}</td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="{{ count($columns) + 1 }}" style="text-align: center;">No record found!</td>
                                            </tr>
                                        @endforelse
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $data->links() }}
                        </div>
                        <div class="overlay" wire:loading.flex wire:loading.flex wire:target="searchQuery,sortBy,pageSize,previousPage,nextPage,gotoPage,delete">
                            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                        </div>
                    </div>
                    @endpermission
                </div>
            </div>
        </div>
    </div>
</div>
