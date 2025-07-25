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
                    <h3 class="card-title">A record of all Recommendations</h3>
                    <div class="card-tools">
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
                    </div>
                </div>
                <div class="card-body">
                    @permission('view.recommendation.history.of.all.users')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools"></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Career Choice</th>
                                        <th>Requested At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @forelse ($data as $item)
                                            <tr wire:key="{{ $item->id }}">
                                                <td>{{ $item->user->fullname }}</td>
                                                <td>{{ $item->career_choice }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm" wire:click="openEditorModal('{{ $item->id }}','{{ $item->created_at }}')">
                                                        <span wire:loading wire:target="openEditorModal('{{ $item->id }}','{{ $item->created_at }}')">
                                                            <i class="fas fa-1x fa-spinner fa-spin"></i>
                                                        </span>
                                                        <span wire:loading.remove wire:target="openEditorModal('{{ $item->id }}','{{ $item->created_at }}')">View</span>
                                                    </button>
                                                    @permission('delete.recommendation.history.of.all.users')
                                                    <button class="btn btn-danger btn-sm" wire:click="delete('{{ $item->id }}')">Delete</button>
                                                    @endpermission
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" style="text-align: center;">No record found!</td>
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
                                    <h4 class="modal-title">Recommendations provided on {{ $selectedRecord_RecommendationDate }}</h4>
                                    <button type="button" wire:click="closeEditorModel" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="modal-body card-comments">
                                    @livewire('recommendations.view', ['recommendation_id' => $selectedRecord_RecommendationID], key($selectedRecord_RecommendationID))
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
