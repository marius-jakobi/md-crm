<?php


namespace App\View\Components\Forms;

use Illuminate\View\Component;

abstract class FormInput extends Component
{
    /**
     * @var string Caption of the input field
     */
    public string $caption;

    /**
     * Create a new component instance.
     *
     * @param string $caption
     * @param int $maxLength
     */
    public function __construct(string $caption)
    {

        $this->caption = $caption;
    }
}
