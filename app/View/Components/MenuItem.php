<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class MenuItem extends Component
{
    public $children;
    public $route;
    public $icon;

    /**
     * Create a new component instance.
     *
     * @param $children
     * @param $route
     * @param $icon
     */
    public function __construct($children = null, $route = null, $icon = null)
    {
        //
        $this->children = $children;
        $this->route = $route;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.menu-item');
    }
}
