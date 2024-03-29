<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $menuActive;
    public $menuOpen;
    public function __construct($menuActive = "", $menuOpen = "")
    {
        $this->menuActive = $menuActive;
        $this->menuOpen = $menuOpen;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
