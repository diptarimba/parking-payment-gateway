<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Accordion extends Component
{
    public $parentName, $uniqueIdHeading, $uniqueIdItem, $body, $header;

    protected $key;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($keyword, $body = null, $header = null, $parentName = null)
    {
        $this->key = md5($keyword);
        $this->uniqueIdItem = 'I'.substr($this->key, 0, 9);
        $this->uniqueIdHeading = 'H'.substr($this->key, 2, 9);
        $this->body = $body ? $body : '';
        $this->header = $header ? $header : '';
        $this->parentName = $parentName ? $parentName : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.accordion');
    }
}
