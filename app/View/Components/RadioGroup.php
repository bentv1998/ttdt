<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class RadioGroup extends Component
{
    public $id;
    public $name;
    public $label;
    public $class;
    public $options;
    public $value;
    public $helpText;
    public $inline;
    public $required;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $label
     * @param bool $inline
     * @param string $id
     * @param string $class
     * @param array $options
     * @param null $value
     * @param bool $required
     * @param string $helpText
     */
    public function __construct($name, $label, $inline = true, $id = '', $class = 'form-control', $options = [], $value = null, $required = false, $helpText = '')
    {
        $this->id = $id;
        $this->inline = $inline;
        $this->name = $name;
        $this->helpText = $helpText;
        $this->class = $class;
        $this->options = $options;
        $this->value = $value;
        $this->label = $label;
        $this->value = $value;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.radio-group');
    }
}
