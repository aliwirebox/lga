<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class AppNavigationComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = getCurrentUser();

        $view->with('user', $user);
    }
}

