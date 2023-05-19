<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filmeTile extends Component
{
    public $filme;
    /**
     * Create a new component instance.
     */
    public function __construct($filme)
    {
        $this->filme = $filme;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filme-tile');
    }
}
