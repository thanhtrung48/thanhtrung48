<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class MainMenu extends Component
{

    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        $list_menu = Menu::all();
        return view('components.main-menu',compact( 'list_menu'));
    }
}
