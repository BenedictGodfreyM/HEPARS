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
                    <h3 class="card-title">System Roles</h3>
                    <div class="card-tools">
                        <div class="btn-group show">
                            @permission('create.roles')
                            <button class="btn btn-sm btn-info"  wire:click="openCreatorModal()">
                                <i class="fas fa-plus"></i> Register
                            </button>
                            @endpermission
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @permission('view.roles')
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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @forelse ($data as $item)
                                            <tr wire:key="{{ $item->id }}">
                                                @foreach ($columns as $column)
                                                    <td>{{ $item->$column }}</td>
                                                @endforeach
                                                <td>
                                                    <button class="btn btn-info btn-sm" wire:click="openDetailsModal('{{ $item->id }}')">
                                                        <span wire:loading wire:target="openDetailsModal('{{ $item->id }}')">
                                                            <i class="fas fa-1x fa-spinner fa-spin"></i>
                                                        </span>
                                                        <span wire:loading.remove wire:target="openDetailsModal('{{ $item->id }}')">View</span>
                                                    </button>
                                                    @if(!in_array($item->slug, ["admin", "user", "unverified"]))
                                                    @permission('edit.roles')
                                                    <button class="btn btn-primary btn-sm" wire:click="openEditorModal('{{ $item->id }}')">
                                                        <span wire:loading wire:target="openEditorModal('{{ $item->id }}')">
                                                            <i class="fas fa-1x fa-spinner fa-spin"></i>
                                                        </span>
                                                        <span wire:loading.remove wire:target="openEditorModal('{{ $item->id }}')">Edit</span>
                                                    </button>
                                                    @endpermission
                                                    @permission('delete.roles')
                                                    <button class="btn btn-danger btn-sm" wire:click="delete('{{ $item->id }}')">Delete</button>
                                                    @endpermission
                                                    @endif
                                                </td>
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
                    @if($showDetailsModel)
                    <div class="modal fade show" id="modal-lg" style="display: block; padding-right: 15px;" aria-modal="true" role="dialog">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Role Details</h4>
                                    <button type="button" wire:click="closeDetailsModel" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="modal-body card-comments">
                                    @livewire('roles.view', ['role_id' => $selectedRecord_RoleID], key($selectedRecord_RoleID))
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($showCreatorModel)
                    <div class="modal fade show" id="modal-lg" style="display: block; padding-right: 15px;" aria-modal="true" role="dialog">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Register Roles</h4>
                                    <button type="button" wire:click="closeCreatorModel" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="modal-body card-comments">
                                    @livewire('roles.register', key("asdfghjkl12345678"))
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($showEditorModel)
                    <div class="modal fade show" id="modal-lg" style="display: block; padding-right: 15px;" aria-modal="true" role="dialog">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Role Details</h4>
                                    <button type="button" wire:click="closeEditorModel" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="modal-body card-comments">
                                    @livewire('roles.edit', ['role_id' => $selectedRecord_RoleID], key($selectedRecord_RoleID))
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endpermission
                </div>
            </div>
        </div>
    </div>
</div>
