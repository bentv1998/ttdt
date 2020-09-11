<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ChooseBeneficiary extends Component
{
    public $groupElement;
    public $beneficiaries;
    public $showBeneficiary;
    public $label;
    public $id;
    public $model;

    /**
     * Create a new component instance.
     *
     * @param $groupElement
     * @param $beneficiaries
     * @param $showBeneficiary
     * @param $label
     * @param $id
     * @param $model
     */
    public function __construct($groupElement, $beneficiaries, $showBeneficiary = false, $label = '', $id = '', $model = null)
    {
        $this->groupElement = $groupElement;
        $this->beneficiaries = $beneficiaries;
        $this->showBeneficiary = $showBeneficiary;
        $this->label = $label;
        $this->model = $model;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.choose-beneficiary');
    }
}
