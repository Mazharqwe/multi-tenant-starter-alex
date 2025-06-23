<?php

namespace App\View\Components\SuperAdmin;

use Illuminate\View\Component;

class TenantRow extends Component
{
    public $tenant;

    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }

    public function render()
    {
        return view('super-admin.components.tenant-row');
    }
} 