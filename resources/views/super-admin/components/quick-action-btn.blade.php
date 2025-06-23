@props(['icon', 'text', 'onclick' => null])

<a href="#" class="quick-action-btn" @if($onclick) onclick="{{ $onclick }}" @endif>
    <i class="{{ $icon }}"></i>
    <span>{{ $text }}</span>
</a>

<style>
    .quick-action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 1.5rem;
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        text-decoration: none;
        color: #6c757d;
        transition: all 0.3s;
        height: 120px;
    }

    .quick-action-btn:hover {
        border-color: var(--secondary-color);
        color: var(--secondary-color);
        background: rgba(52, 152, 219, 0.05);
    }

    .quick-action-btn i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
</style> 