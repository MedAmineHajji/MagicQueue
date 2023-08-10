<?php

namespace App\View\Components\tinyMCE;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class tinymceConfig extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tiny-m-c-e.tinymce-config');
    }
}
