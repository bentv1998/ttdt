<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ListContentHead extends Component
{

    public $title;
    public $createRoute;
    public $createButtonLabel;
    public $importRoute;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $createRoute
     * @param $createButtonLabel
     * @param string $importRoute
     */
    public function __construct($title, $createRoute, $createButtonLabel, $importRoute = null)
    {
        $this->title = $title;
        $this->createRoute = $createRoute;
        $this->createButtonLabel = $createButtonLabel;
        $this->importRoute = $importRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.list-content-head');
    }
}
