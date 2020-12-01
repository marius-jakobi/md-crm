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
     * @var int max length of the input
     */
    public int $maxLength;

    /**
     * Create a new component instance.
     *
     * @param string $caption
     * @param int $maxLength
     */
    public function __construct(string $caption, int $maxLength)
    {

        $this->caption = $caption;
        $this->maxLength = $maxLength;
    }
}
