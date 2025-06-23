<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasFactory, HasDatabase, HasDomains;

    protected $fillable = [
        'id',
        'name',
        'domain',
        'email',
        'phone',
        'address',
        'is_active',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function ($tenant) {
            $tenant->id = $tenant->id ?? str_replace([' ', '.'], '-', strtolower($tenant->name));
            
            // Store email in main email field for compatibility
            if (isset($tenant->data['admin_email'])) {
                $tenant->email = $tenant->data['admin_email'];
            }
        });

        static::updating(function ($tenant) {
            // Update main email field when admin_email in data changes
            if (isset($tenant->data['admin_email'])) {
                $tenant->email = $tenant->data['admin_email'];
            }
        });
    }

    public function getTenantKeyName(): string
    {
        return 'id';
    }

    public function getTenantKey()
    {
        return $this->getAttribute($this->getTenantKeyName());
    }

    // Accessor methods for admin data
    public function getAdminEmailAttribute()
    {
        return $this->data['admin_email'] ?? $this->email ?? null;
    }

    public function getAdminNameAttribute()
    {
        return $this->data['admin_name'] ?? null;
    }

    public function getAdminPhoneAttribute()
    {
        return $this->data['phone'] ?? $this->phone ?? null;
    }

    public function getAdminAddressAttribute()
    {
        return $this->data['address'] ?? $this->address ?? null;
    }

    public function getSubscriptionPlanAttribute()
    {
        return $this->data['subscription_plan'] ?? 'basic';
    }

    public function getTrialPeriodAttribute()
    {
        return $this->data['trial_period'] ?? 0;
    }

    public function getFeaturesAttribute()
    {
        return $this->data['features'] ?? [];
    }

    public function getSendWelcomeAttribute()
    {
        return $this->data['send_welcome'] ?? true;
    }
} 