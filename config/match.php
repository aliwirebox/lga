<?php

return [

    //Constants to make queries more readable

    'cv-request' => 100,

    'cv-rejected' => 200,

    'unsuccessful' => 250,

    'cv-pending' => 300,

    'cv-sent' => 400,

    'first-interview' => 500,

    'second-interview' => 600,

    'offer' => 700,

    //Data to make buttons for GUI

    'statuses' => [

        700 => [ //Additional admin status
                 'candidates' => ['text' => 'Offer', 'colour' => 'btn-success'],
                 'hirers'     => ['text' => 'Offer', 'colour' => 'btn-success'],
                 'brand_admins'  => ['text' => 'Offer', 'colour' => 'btn-success'],
        ],

        600 => [ //Additional BRAND admin status
                 'candidates' => ['text' => 'Second Interview', 'colour' => 'btn-success'],
                 'hirers'     => ['text' => 'Second Interview', 'colour' => 'btn-success'],
                 'brand_admins'  => ['text' => 'Second Interview', 'colour' => 'btn-success'],
        ],

        500 => [ //Additional BRAND admin status
                 'candidates' => ['text' => 'First Interview', 'colour' => 'btn-success'],
                 'hirers'     => ['text' => 'First Interview', 'colour' => 'btn-success'],
                 'brand_admins'  => ['text' => 'First Interview', 'colour' => 'btn-success'],
        ],

        400 => [ //BRAND  Admin has sent CV to Hirer
                 'candidates' => ['text' => 'CV Sent', 'colour' => 'btn-warning'],
                 'hirers'     => ['text' => 'CV Received', 'colour' => 'btn-warning'],
                 'brand_admins'  => ['text' => 'CV Sent', 'colour' => 'btn-warning'],
        ],

        300 => [ //Candidate has accepted CV request and BRAND Admin needs to taylor CV before sending to Hirer
                 'candidates' => ['text' => 'CV Sent', 'colour' => 'btn-warning'],
                 'hirers'     => ['text' => 'CV Requested', 'colour' => 'btn-primary'],
                 'brand_admins'  => ['text' => 'CV Processing', 'colour' => 'btn-danger'],
        ],

        250 => [ //Additional admin status
                 'candidates' => ['text' => 'Unsuccessful', 'colour' => 'btn-danger'],
                 'hirers'     => ['text' => 'Unsuccessful', 'colour' => 'btn-danger'],
                 'brand_admins'  => ['text' => 'Unsuccessful', 'colour' => 'btn-danger'],
        ],

        200 => [ //Candidate has refused CV request
                 'candidates' => ['text' => 'CV Request Rejected', 'colour' => 'btn-danger'],
                 'hirers'     => ['text' => 'CV Request Rejected', 'colour' => 'btn-danger'],
                 'brand_admins'  => ['text' => 'CV Request Rejected', 'colour' => 'btn-danger'],
        ],

        100 => [ //Hirer has requested CV
                 'candidates' => ['text' => 'CV Requested', 'colour' => 'btn-primary'],
                 'hirers'     => ['text' => 'CV Requested', 'colour' => 'btn-primary'],
                 'brand_admins'  => ['text' => 'CV Requested', 'colour' => 'btn-primary'],
        ],

        0 => [ //No interaction candidate has only been matched
               'candidates' => ['text' => '', 'colour' => ''],
               'hirers'     => ['text' => '', 'colour' => ''],
               'brand_admins'  => ['text' => '', 'colour' => ''],
        ],

    ],

];
