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
                    'login' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/login'
                        ]
                    ],
                    'logout' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/logout',
                            'defaults' => [
                                'action' => 'logout'
                            ]
                        ]
                    ]
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
            'authentication.adapter.member' => 'Auth\Service\MemberAuthAdapter'
        ],
        'factories' => [
            'auth.handler' => function ($sm) {
                    $handler = new \Auth\Service\AuthHandler;
                    $handler->setAdapter($sm->get('auth.adapter'));
                    return $handler;
                },
        ],
        'aliases' => [
            'auth.adapter' => 'authentication.adapter.member',
            'Zend\Authentication\AuthenticationService' => 'auth.handler'
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];