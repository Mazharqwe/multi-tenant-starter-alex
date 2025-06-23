<?php

namespace App\View\Components\SuperAdmin;

use Illuminate\View\Component;

class ActivityItem extends Component
{
    public $icon;
    public $color;
    public $title;
    public $description;
    public $time;

    public function __construct($icon = '', $color = '', $title = '', $description = '', $time = '')
    {
        $this->icon = $icon;
        $this->color = $color;
        $this->title = $title;
        $this->description = $description;
        $this->time = $time;
    }

    public function render()
    {
        return view('super-admin.components.activity-item');
    }
} 