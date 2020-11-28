<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * @var string Can be 'error', 'warning', 'info' or 'success'
     */
    public string $type;

    /**
     * @var string Message to display
     */
    public string $message;

    /**
     * @var bool Message can be closed
     */
    public bool $dismissible;

    /**
     * Alert constructor.
     * @param string $type
     * @param string $message
     * @param bool $dismissible
     */
    public function __construct(string $type, string $message, bool $dismissible = false)
    {
        $this->type = $type;
        $this->message = $message;
        $this->dismissible = $dismissible;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
