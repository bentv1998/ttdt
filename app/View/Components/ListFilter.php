<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ListFilter extends Component
{
    public $id;
    public $name;
    public $options;
    public $class;
    public $colClass;
    public $label;
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @param string $id
     * @param string $name
     * @param array $options
     * @param string $class
     * @param string $colClass
     * @param string $label
     * @param string $placeholder
     */
    public function __construct($id, $name, $options = [], $class = '', $colClass = '', $label = '', $placeholder = '')
    {

        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
        $this->class = $class;
        $this->colClass = $colClass;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.list-filter');
    }
}
