<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ListTable extends Component
{
    public $id;
    public $filters;
    public $colClass;
    public $class;

    /**
     * Create a new component instance.
     *
     * @param string $id
     * @param array $filters
     * @param string $colClass
     * @param string $class
     */
    public function __construct($id, $filters = [], $colClass = null, $class = null)
    {

        $this->id = $id;
        $this->colClass = $colClass;
        $this->class = $class;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.list-table');
    }
}
