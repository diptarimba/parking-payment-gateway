<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class wsGroupItem extends Component
{
    public $varian, $identify, $min, $max, $price, $idWholeSaler, $eachIdent;

    public function __construct($varian, $min = null, $max = null, $price = null, $identify = null, $idWholeSaler = null)
    {
        $this->varian = $varian;
        $this->min = $min ?? "";
        $this->max = $max ?? "";
        $this->price = $price ?? "";
        $this->identify = $identify ?? "";
        $this->idWholeSaler = $idWholeSaler ?? "";
        $this->eachIdent = substr(md5(rand(1,99)), 0, 5);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.wsgroupitem');
    }
}
