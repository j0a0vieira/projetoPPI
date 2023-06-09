<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filmeTile extends Component
{
    public $filme;
    public $sessoes;

    public function __construct($filme, $sessoes)
    {
        $this->filme = $filme;
        $this->sessoes = $sessoes;
    }

    public function render(): View|Closure|string
    {
        return view('components.filme-tile');
    }
}
