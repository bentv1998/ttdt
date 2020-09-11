<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Wizard extends Component
{
    public $wizards;

    /**
     * Create a new component instance.
     *
     * @param $wizards
     */
    public function __construct($wizards)
    {
        $this->wizards = $wizards;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.wizard');
    }
}
