<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'       => "PostCheck", // set false to total remove
            'description' => 'A simple tool for checking your posts for spelling and grammar mistakes', // set false to total remove
            'separator'   => ' - ',
            'keywords'    => ['social media', 'spelling mistakes', 'spell checker'],
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'PostCheck', // set false to total remove
            'description' => 'A simple tool for checking your posts for spelling and grammar mistakes', // set false to total remove
            'url'         => false,
            'type'        => 'website',
            'site_name'   => 'PostCheck',
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          //'card'        => 'summary',
          //'site'        => '@LuizVinicius73',
        ],
    ],
];
