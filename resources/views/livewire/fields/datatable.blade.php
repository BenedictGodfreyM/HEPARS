<div>
    @if(session()->has('success'))
    <livewire:shared.alert title="Success!" message="{{ session()->get('success') }}" css_class="alert-success" icon="fa-check" />
    @endif
    @if(session()->has('error'))
    <livewire:shared.alert title="Error!" message="{{ session()->get('error') }}" css_class="alert-danger" icon="fa-ban" />
    @endif
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
                            <tr>
                                @foreach ($columns as $column)
                                    <td>{{ $item->$column }}</td>
                                @endforeach
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('fields.careers', ['field_id' => $item->id]) }}">Careers</a>
                                    <a href="{{ route('fields.edit', ['field_id' => $item->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm" wire:click="delete('{{ $item->id }}')">Delete</button>
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
        <div class="overlay" wire:loading.flex>
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
    </div>
</div>
