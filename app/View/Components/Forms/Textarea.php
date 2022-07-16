<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $value;

    public $label;

    public $name;

    public $placeholder;

    public function __construct($value, $label, $name, $placeholder = "") {
        $this->value = $value;
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.textarea');
    }
}
