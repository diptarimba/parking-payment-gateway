<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public $items;

    public $name;

    public $value;

    public $label;

    public $placeholder;

    public $multiple;

    public function __construct($items, $name, $value, $label, $placeholder = '', $multiple = null)
    {
        $this->items = $items;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->multiple = $multiple ? 'multiple' : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select');
    }
}
