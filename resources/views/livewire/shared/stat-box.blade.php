<div>
    <div class="small-box {{ $stat_box_css_class }}">
        <div class="overlay" wire:loading>
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        </div>
        <div class="inner">
            <h3>{{ $stat_count }}</h3>

            <p>{{ $stat_label }}</p>
        </div> 
        <div class="icon">
            <i class="ion {{ $stat_box_icon }}"></i>
        </div>
        <a href="{{ route($stat_referral_route) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
