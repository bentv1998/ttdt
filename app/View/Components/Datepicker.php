<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Datepicker extends Component
{
    public $name;
    public $label;
    public $value;
    public $placeholder;
    public $class;
    public $required;
    public $helpText;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $label
     * @param string $value
     * @param string $placeholder
     * @param string $class
     * @param bool $required
     * @param string $helpText
     */
    public function __construct($name, $label, $value = '', $placeholder = '', $class = '', $required = false, $helpText = '')
    {
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->label = $label;
        $this->required = $required;
        $this->helpText = $helpText;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.datepicker');
    }
}
