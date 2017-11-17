<?php

return [
    
    'candidate-options' => [
        0  => 'Any',
        18 => '18k+',
        22 => '22k+',
        26 => '26k+',
        30 => '30k+',
        34 => '34k+',
        38 => '38k+',
        42 => '42k+',
        46 => '46k+',
        50 => '50k+',
        54 => '54k+',
        58 => '58k+',
    ],

    'vacancy-options' => [
        18 => 'to 18k',
        22 => 'to 22k',
        26 => 'to 26k',
        30 => 'to 30k',
        34 => 'to 34k',
        38 => 'to 38k',
        42 => 'to 42k',
        46 => 'to 46k',
        50 => 'to 50k',
        54 => 'to 54k',
        58 => 'to 58k',
        100000 => '58k+',
        /*
         * The 58k+ is effectively the "Any" option for hirers. To stop us putting a special
         * condition in the search for this option the number is set very high, much higher
         * than a candidate can ask for.
         */
    ],

];
