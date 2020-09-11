<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use Illuminate\View\View;

class StandardForm extends Component
{
    public $title;
    public $mode;
    public $storeRoute;
    public $updateRoute;
    public $fields;
    public $model;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $mode
     * @param $storeRoute
     * @param string $updateRoute
     * @param array $fields
     * @param Model $model
     */
    public function __construct($title, $mode, $storeRoute, $updateRoute, $fields, $model = null)
    {
        $this->title = $title;
        $this->mode = $mode;
        $this->storeRoute = $storeRoute;
        $this->updateRoute = $updateRoute;
        $this->fields = $fields;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.standard-form');
    }
}
