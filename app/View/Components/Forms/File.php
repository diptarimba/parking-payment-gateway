<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class File extends Component
{
    public $multiple;

    public $name;

    public $label;
    public $id;

    public function __construct($label, $name, $multiple = null, $id = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->multiple = $multiple ? 'multiple' : '';
        $this->id = $id ? $id : substr(md5(now()),0,5);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.file');
    }
}
