@props(['icon', 'color', 'title', 'description', 'time'])

<div class="activity-item">
    <div class="activity-icon {{ $color }} text-white">
        <i class="{{ $icon }}"></i>
    </div>
    <div class="activity-content">
        <p class="activity-title">{{ $title }}</p>
        <p class="activity-desc">{{ $description }}</p>
    </div>
    <div class="activity-time">{{ $time }}</div>
</div>

<style>
    .activity-item {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 0.9rem;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 600;
        color: var(--primary-color);
        margin: 0 0 0.25rem;
    }

    .activity-desc {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0;
    }

    .activity-time {
        color: #adb5bd;
        font-size: 0.8rem;
    }
</style> 