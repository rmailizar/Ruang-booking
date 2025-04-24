<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavLink extends Component
{
    public $active;

    /**
     * Create a new component instance.
     *
     * @param bool $active
     */
    public function __construct($active = false)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.nav-link');
    }
}
