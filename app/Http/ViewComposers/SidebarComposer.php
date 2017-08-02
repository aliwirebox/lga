<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view)
    {
        $user = getCurrentUser();
        $menu = getGuard();
        $view->with('menu', $menu)
            ->with('user', $user);
    }
}
