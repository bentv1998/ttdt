<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DropdownMultiple extends Component
{
    public $id;
    public $name;
    public $placeholder;
    public $label;
    public $class;
    public $options;
    public $value;
    public $required;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $label
     * @param string $id
     * @param string $class
     * @param array $options
     * @param null $value
     * @param string $placeholder
     * @param bool $required
     */
    public function __construct($name, $label, $id = '', $class = 'form-control kt-select2', $options = [], $value = null, $placeholder = '', $required = false)
    {
        //
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
        $this->options = $options;
        $this->value = $value;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.dropdown-multiple');
    }
}
