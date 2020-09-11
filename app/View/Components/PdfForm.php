<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PdfForm extends Component
{
    public $fields;
    public $model;

    /**
     * Create a new component instance.
     *
     * @param $model
     * @param $fields
     */
    public function __construct($model, $fields)
    {
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
        return view('components.pdf-form');
    }
}
