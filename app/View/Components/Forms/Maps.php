<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Maps extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $identifier = '',
        public $lat = 60,
        public $lng = 110,
        public $latName = 'latitude',
        public $lngName = 'longitude',
    )
    {
        $this->lat != null ?: $this->lat = -6.991561007971386;
        $this->lng != null ?: $this->lng = 470.4270923137666;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.maps');
    }
}
