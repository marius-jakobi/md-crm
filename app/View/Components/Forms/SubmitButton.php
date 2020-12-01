<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    public string $caption;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $caption)
    {
        $this->caption = $caption;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.submit-button');
    }
}
