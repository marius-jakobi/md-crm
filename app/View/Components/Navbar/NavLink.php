<?php

namespace App\View\Components\Navbar;

use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * @var string The name of the route
     */
    public string $route;

    /**
     * Create a new component instance.
     *
     * @param string $route The name of the route
     */
    public function __construct(string $route)
    {

        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.navbar.navlink');
    }
}
