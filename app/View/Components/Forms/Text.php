<?php

namespace App\View\Components\Forms;

class Text extends FormInput
{
    public string $name;

    public function __construct(string $name, string $caption, int $maxLength)
    {
        parent::__construct($caption, $maxLength);
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.text');
    }
}
