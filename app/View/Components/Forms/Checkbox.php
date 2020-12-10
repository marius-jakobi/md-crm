<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * @var string Name of the input field
     */
    public string $name;

    /**
     * @var string Caption of the checkbox
     */
    public string $caption;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $caption
     */
    public function __construct(string $name, string $caption)
    {
        $this->name = $name;
        $this->caption = $caption;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.checkbox');
    }
}
