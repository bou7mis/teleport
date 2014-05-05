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
                    $adapter = $sm->get('auth.adapter');
                    $adapter->setServiceLocator($sm);
                    $handler->setAdapter($adapter);
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
    ],
    'view_helper_config' => [
        'flashmessenger' => [
            'message_open_format' => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_close_string' => '</li></ul></div>',
            'message_separator_string' => '</li><li>'
        ]
    ]
];