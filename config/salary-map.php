<?php

return [
    
    'candidate-options' => [
        0  => 'Any',
        30 => '30k+',
        35 => '35k+',
        40 => '40k+',
        45 => '45k+',
        50 => '50k+',
        55 => '55k+',
        60 => '60k+',
        65 => '65k+',
        70 => '70k+',
        75 => '75k+',
        80 => '80k+',
        85 => '85k+',
        90 => '90k+',
        95 => '95k+',
        100 => '100k+',
    ],

    'vacancy-options' => [
        30 => 'to 30k',
        35 => 'to 35k',
        40 => 'to 40k',
        45 => 'to 45k',
        50 => 'to 50k',
        55 => 'to 55k',
        60 => 'to 60k',
        65 => 'to 65k',
        70 => 'to 70k',
        75 => 'to 75k',
        80 => 'to 80k',
        85 => 'to 85k',
        90 => 'to 90k',
        95 => 'to 95k',
        100 => 'to 100k',
        100000 => '100k+', 
        /*
         * The 100k+ is effectively the "Any" option for hirers. To stop us putting a special 
         * condition in the search for this option the number is set very high, much higher 
         * than a candidate can ask for.  
         */
    ],

];
