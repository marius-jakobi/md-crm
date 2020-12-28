<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textarea extends Component
{
    public string $caption;
    public string $name;
    public int $rows;

    /**
     * Create a new component instance.
     *
     * @param string $caption Label caption
     * @param int $rows Textarea rows
     * @param string $name Name of the textarea field
     */
    public function __construct(string $caption, string $name, int $rows = 5)
    {
        //
        $this->caption = $caption;
        $this->name = $name;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.textarea');
    }
}
