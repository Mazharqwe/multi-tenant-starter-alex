<?php

namespace App\View\Components\SuperAdmin;

use Illuminate\View\Component;

class QuickActionBtn extends Component
{
    public $icon;
    public $text;
    public $onclick;

    public function __construct($icon = '', $text = '', $onclick = null)
    {
        $this->icon = $icon;
        $this->text = $text;
        $this->onclick = $onclick;
    }

    public function render()
    {
        return view('super-admin.components.quick-action-btn');
    }
} 