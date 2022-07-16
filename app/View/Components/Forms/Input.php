<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $value, $label, $name, $placeholder, $type, $input, $required;

    public function __construct($value, $label, $name, $placeholder = '', $type = null, $required = null) {
        $this->value = $value;
        $this->label = $label;
        $this->name = $name;
        $this->input = $name;
        $this->required = $required ? 'required' : '';
        $this->placeholder = $placeholder;
        $this->type = $type ?? 'text';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
