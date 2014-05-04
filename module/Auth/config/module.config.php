<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 04/05/14
 * Time: 14:41
 */

return [
    'router' => [
        'routes' => [
            'auth' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/auth',
                    'defaults' => [
                        '__NAMESPACE__' => 'auth',
                        'controller' => 'index',
                        'action' => 'login'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [

                ]
            ]
        ]
    ],
    'controllers' => [
        'invokables' => [
            'auth\index' => 'Auth\Controller\IndexController'
        ]
    ],
    'service_manager' => [
        'invokables' => [

        ],
        'factories' => [

        ],
        'aliases' => [

        ]
    ],
    'form_elements' => [

    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];