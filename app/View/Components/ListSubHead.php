<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ListSubHead extends Component
{
    public $filters;

    /**
     * Create a new component instance.
     *
     * @param array $filters
     */
    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.list-sub-head');
    }
}
