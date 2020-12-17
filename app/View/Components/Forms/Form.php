<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.form');
    }
}
