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
    <div class="card card-primary">
        <!-- form start -->
        <form wire:submit="registerRole" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="inputRoleName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputRoleName" placeholder="Enter role name (Eg. Administrator )" wire:model="name">
                    @error('name')
                    <span id="inputRoleName-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputRoleDescription">Description</label>
                    <textarea id="inputRoleDescription" class="form-control @error('description') is-invalid @enderror" placeholder="Enter role description (Eg. Administrator Role )" wire:model="description"></textarea>
                    @error('description')
                    <span id="inputRoleDescription-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputRoleLevel">Level</label>
                    <input type="number" class="form-control @error('level') is-invalid @enderror" id="inputRoleLevel" placeholder="Enter Role level (Eg. 5 )" wire:model="level">
                    @error('level')
                    <span id="inputRoleLevel-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputRolePermissions">Permissions</label>
                    <select class="form-control" wire:change="addPermissionToSelection($event.target.value)" id="inputRolePermissions" wire:model="selectedOption">
                        <option selected disabled value="">Select Permissions</option>
                        @forelse ($availablePermissions as $permission)
                        <option value="{{ $permission['id'] }}">{{ $permission['name'] }}</option>
                        @empty
                        <option value="">No Data Available</option>
                        @endforelse
                    </select>
                </div>
                @if(count($selectedPermissions) > 0)
                @foreach($selectedPermissions as $index => $permissionData)
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ $permissionData['name'] }}" required readonly>
                        <div class="input-group-append">
                            <button type="button" wire:click="removePermissionFromSelection({{ $index }})" class="btn btn-danger">
                                <i class="fa fa-times" aria-hidden="true" wire:loading.remove wire:target="removePermissionFromSelection({{ $index }})"></i>
                                <i class="fas fa-1x fa-spinner fa-spin" aria-hidden="true" wire:loading wire:target="removePermissionFromSelection({{ $index }})"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                <div class="form-group">
                    <label class="pl-4" style="width: 100%;text-align: center;" wire:loading wire:target="addPermissionToSelection">
                        <i class="fas fa-1x fa-spinner fa-spin"></i>
                    </label>
                </div>
            </div>  
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">
                    <span wire:loading wire:target="registerRole"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                    <span wire:loading.remove wire:target="registerRole">Submit</span>
                </button>
            </div>
        </form>
    </div>
</div>
