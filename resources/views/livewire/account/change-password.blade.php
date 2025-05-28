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
    <form wire:submit="setNewPassword" action="" autocomplete="off">
        <div class="form-group">
            <label for="inputCurrentPassword">Current Password</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="inputCurrentPassword" placeholder="Enter your current password" wire:model="current_password">
            @error('current_password')
            <span id="inputCurrentPassword-Error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputNewPassword">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputNewPassword" placeholder="Enter new password" wire:model="password">
            @error('password')
            <span id="inputNewPassword-Error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="inputConfirmPassword">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputConfirmPassword" placeholder="Confirm the new password" wire:model="password_confirmation">
            @error('password_confirmation')
            <span id="inputConfirmPassword-Error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-center mt-2 mb-3">
            <button type="submit" class="btn btn-primary btn-block">
                <span wire:loading wire:target="setNewPassword"><i class="fas fa-1x fa-sync-alt fa-spin"></i> Saving...</span>
                <span wire:loading.remove wire:target="setNewPassword">Save</span> 
            </button>
        </div>
    </form>
</div>
