<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionBtn extends Component
{
    public $route;
    public $icon;
    public $title;

    public function __construct($route, $icon, $title)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.action-btn');
    }
}
