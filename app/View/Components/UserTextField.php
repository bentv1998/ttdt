<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class UserTextField extends Component
{
    public $type;
    public $name;
    public $label;
    public $id;
    public $value;
    public $placeholder;
    public $class;
    public $readOnly;
    public $disabled;
    public $required;
    public $helpText;

    /**
     * Create a new component instance.
     *
     * @param $type
     * @param $name
     * @param $label
     * @param string $id
     * @param string $value
     * @param string $placeholder
     * @param string $class
     * @param bool $required
     * @param string $helpText
     * @param bool $readOnly
     * @param bool $disabled
     */
    public function __construct($type, $name, $label, $id = '', $value = '', $placeholder = '', $class = '', $required = false, $helpText = '', $readOnly = false, $disabled = false)
    {
        $this->type = $type;
        $this->readOnly = $readOnly;
        $this->disabled = $disabled;
        $this->name = $name;
        $this->id = $id;
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
     * @return View|string
     */
    public function render()
    {
        return view('components.user-text-field');
    }
}
