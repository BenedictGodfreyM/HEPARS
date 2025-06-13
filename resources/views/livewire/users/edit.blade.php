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
        <form wire:submit="updateUserDetails" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="inputUserFullname">Name</label>
                    <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="inputUserFullname" wire:model="fullname" readonly>
                    @error('fullname')
                    <span id="inputUserFullname-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputUserEmail">Email Address</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputUserEmail" wire:model="email" readonly>
                    @error('email')
                    <span id="inputUserEmail-Error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputUserRoles">Roles</label>
                    <select class="form-control" wire:change="addRoleToSelection($event.target.value)" id="inputUserRoles" wire:model="selectedOption">
                        <option selected disabled value="">Select a Role</option>
                        @forelse ($availableRoles as $role)
                        <option value="{{ $role['id'] }}" @if($role['slug'] == "admin") disabled @endif>{{ $role['name'] }}</option>
                        @empty
                        <option value="">No Data Available</option>
                        @endforelse
                    </select>
                </div>
                @if($selectedRole)
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ $selectedRole['name'] }}" required readonly>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="pl-4" style="width: 100%;text-align: center;" wire:loading wire:target="addRoleToSelection">
                        <i class="fas fa-1x fa-spinner fa-spin"></i>
                    </label>
                </div>
            </div>  
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">
                    <span wire:loading wire:target="updateUserDetails"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Submitting...</span>
                    <span wire:loading.remove wire:target="updateUserDetails">Submit</span>
                </button>
            </div>
        </form>
    </div>
</div>
