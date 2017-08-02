<?php

namespace App\Http\ViewComposers;

use App\Models\LawFirm;
use Illuminate\View\View;

class HirerRegistrationFormComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $lawFirmList = LawFirm::all();

        $view->with('lawFirmList', $lawFirmList);
    }
}
