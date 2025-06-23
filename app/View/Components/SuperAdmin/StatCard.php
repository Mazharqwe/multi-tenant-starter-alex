<?php

namespace App\View\Components\SuperAdmin;

use Illuminate\View\Component;

class StatCard extends Component
{
    public $type;
    public $icon;
    public $number;
    public $label;
    public $id;

    public function __construct($type = 'primary', $icon = '', $number = '', $label = '', $id = null)
    {
        $this->type = $type;
        $this->icon = $icon;
        $this->number = $number;
        $this->label = $label;
        $this->id = $id;
    }

    public function render()
    {
        return view('super-admin.components.stat-card');
    }
} 