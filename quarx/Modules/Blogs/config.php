<?php

return [
    'forms' => [
        'blogs' => [
            'title'       => [
                'type' => 'string',
            ],
            'author'       => [
                'type' => 'string',
            ],
            'url'       => [
                'type' => 'string',
            ],
            'tags'       => [
                'type' => 'string',
                'class' => 'tags'
            ],
            'entry'       => [
                'type' => 'text',
                'class' => 'redactor',
                'alt_name' => 'Content',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'custom' => 'value="1"',
                'alt_name' => 'Published'
            ],
            'published_at' => [
                'type'     => 'string',
                'class'    => 'datetimepicker',
                'alt_name' => 'Publish Date',
                'after'    => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
            ],
        ],
    ]
];
