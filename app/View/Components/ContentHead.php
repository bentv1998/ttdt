<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ContentHead extends Component
{
    public $title;
    public $breadcrumb;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $breadcrumb
     */
    public function __construct($title, $breadcrumb)
    {
        $this->title = $title;
        $this->breadcrumb = $breadcrumb;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.content-head');
    }
}
