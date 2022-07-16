<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ViewImage extends Component
{
    public $label, $src, $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($src, $label = null, $id = null)
    {
        $this->label = $label ? $label : 'Preview Image';
        $this->src = $src;
        $this->id = $id ? $id : substr(md5(now()), 0, 5);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.view-image');
    }
}
