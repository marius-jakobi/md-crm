<?php

namespace App\View\Components\Forms;

class Email extends FormInput
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.email');
    }
}
