@props(['type' => 'primary', 'icon', 'number', 'label', 'id' => null])

<div class="stat-card {{ $type }}">
    <div class="d-flex align-items-center">
        <div class="stat-icon {{ $type }}">
            <i class="{{ $icon }}"></i>
        </div>
        <div class="ms-3">
            <h3 class="stat-number" @if($id) id="{{ $id }}" @endif>{{ $number }}</h3>
            <p class="stat-label">{{ $label }}</p>
        </div>
    </div>
</div>

<style>
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border-left: 4px solid;
        transition: all 0.3s;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .stat-card.primary { border-left-color: var(--primary-color); }
    .stat-card.success { border-left-color: var(--success-color); }
    .stat-card.warning { border-left-color: var(--warning-color); }
    .stat-card.danger { border-left-color: var(--danger-color); }
    .stat-card.info { border-left-color: var(--info-color); }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stat-icon.primary { background: var(--primary-color); }
    .stat-icon.success { background: var(--success-color); }
    .stat-icon.warning { background: var(--warning-color); }
    .stat-icon.danger { background: var(--danger-color); }
    .stat-icon.info { background: var(--info-color); }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0;
    }
</style> 