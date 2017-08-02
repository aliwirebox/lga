<?php

/*
|--------------------------------------------------------------------------
| Quarx Config
|--------------------------------------------------------------------------
*/

return [

    'frontend-namespace' => '\App\Http\Controllers\Quarx',

    'frontend-theme' => 'default',

    'module-directory' => 'quarx/Modules',

    'storage-location' => 'public',

    'appAdminEmail' => '',

    'appAdminName' => 'NQ Solicitors',

    'registrationAvailable' => false,

    'backend-theme' => 'lumen', // cosmo, cyborg, darkly, flatly, hero, journal, lumen, paper, readable, sandstone, simplex, slate, united, yeti

    'maxFileUploadSize' => 6291456, // 6MB

    'pagination' => 24,

    'apiKey' => 'gALPkYVALEtQYWztKy3d',
    'apiToken' => 'fwCVH1bJEV3GOCyGDDNP',

    'activeCoreModules' => [
        'files',
        'images',
        'pages',
    ],

    'modules' => [
        'blog',
        'menus',
        'files',
        'images',
        'pages',
        'faqs',
    ],

    'forms' => [
        'blog' => [
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
                'alt_name' => 'Published'
            ],
        ],

        'images' => [
            'is_published'      => [
                'type' => 'checkbox',
                'value' => 1
            ],
            'tags'       => [
                'custom' => 'data-role="tagsinput"'
            ],
        ],

        'images-edit' => [
            'location'       => [
                'type' => 'file',
                'alt_name' => 'File'
            ],
            'name'       => [
                'type' => 'string',
            ],
            'alt_tag'       => [
                'type' => 'string',
                'alt_name' => 'Alt Tag',
            ],
            'title_tag'       => [
                'type' => 'string',
                'alt_name' => 'Title Tag',
            ],
            'tags'       => [
                'type' => 'string',
                'class' => 'tags'
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published'
            ],
        ],

        'page' => [
            'title'       => [
                'type' => 'string',
            ],
            'url'       => [
                'type' => 'string',
            ],
            'seo_description'       => [
                'type'     => 'text',
                'alt_name' => 'SEO Description',
            ],
            'seo_keywords'       => [
                'type'     => 'string',
                'class'    => 'tags',
                'alt_name' => 'SEO Keywords',
            ],
             'entry'       => [
                'type' => 'text',
                'class' => 'redactor',
                'alt_name' => 'Content',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published'
            ],
            'published_at' => [
                'type'     => 'string',
                'class'    => 'datetimepicker',
                'alt_name' => 'Publish Date',
                'after'    => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
            ],
        ],

        'widget' => [
            'name'       => [
                'type' => 'string',
            ],
            'uuid'       => [
                'type' => 'string',
            ],
            'content'       => [
                'type' => 'text',
                'class' => 'redactor',
            ],
        ],

        'faqs' => [
            'question'       => [
                'type' => 'string',
            ],
            'answer'       => [
                'type' => 'text',
                'class' => 'redactor',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published'
            ],
            'published_at' => [
                'type'     => 'string',
                'class'    => 'datetimepicker',
                'alt_name' => 'Publish Date',
                'after'    => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
            ],
        ],

        'menu' => [
            'name' => [
                'type' => 'string'
            ],
            'uuid' => [
                'type' => 'string'
            ],
        ],

        'link' => [
            'name'       => [
                'type' => 'string',
            ],
            'external'       => [
                'type' => 'checkbox',
                'custom' => 'value="1"'
            ],
            'external_url' => [
                'type' => 'string',
                'alt_name' => 'Url'
            ],
            'menu_id' => [
                'type' => 'hidden',
            ],
        ],

        'files' => [
            'is_published'      => [
                'type' => 'checkbox',
                'value' => 1
            ],
            'tags'       => [
                'custom' => 'data-role="tagsinput"'
            ],
            'details'       => [
                'type' => 'textarea'
            ],
        ],

        'file-edit' => [
            'name'       => [],
            'is_published'      => [
                'type' => 'checkbox',
                'value' => 1
            ],
            'tags'       => [
                'custom' => 'data-role="tagsinput"'
            ],
            'details'       => [
                'type' => 'textarea'
            ],
        ],

    ]

];
