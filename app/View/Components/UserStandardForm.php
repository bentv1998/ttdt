<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use Illuminate\View\View;

class UserStandardForm extends Component
{
    public $title;
    public $mode;
    public $modelRoute;
    public $fields;
    public $model;
    public $method;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param $modelRoute
     * @param array $fields
     * @param null $method
     * @param Model $model
     */
    public function __construct($title, $modelRoute, $fields, $method = null, $model = null)
    {
        $this->title = $title;
        $this->method = $method;
        $this->modelRoute = $modelRoute;
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
        return view('components.user-standard-form');
    }
}
