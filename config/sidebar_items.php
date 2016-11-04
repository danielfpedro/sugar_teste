<?php

return [
    'items' => [
        null => [
            [
                'label' => 'Posts',
                'icon' => 'pencil-square-o',
                'url' => [
                    'controller' => 'Posts',
                    'action' => 'index'
                ],
                'childs' => [
                    [
                        'controller' => 'Posts',
                        'action' => 'add|edit'
                    ]
                ]
            ],
        ],
        'Sistema' => [
            [
                'label' => 'configurações',
                'icon' => 'users',
                'submenu' => [
                    [
                        'label' => 'Posts',
                        'icon' => 'list',
                        'url' => [
                            'controller' => 'Posts',
                            'action' => 'index'
                        ],
                        'childs' => [
                            [
                                'controller' => 'Posts',
                                'action' => 'add|edit'
                            ]
                        ]
                    ]  
                ]
            ],
            [
                'label' => 'Sistema',
                'icon' => 'users',
                'submenu' => [
                    [
                        'label' => 'Usuários',
                        'icon' => 'users',
                        'url' => [
                            'controller' => 'Users',
                            'action' => 'index'
                        ],
                        'childs' => [
                            [
                                'controller' => 'Users',
                                'action' => 'add'
                            ],
                            [
                                'controller' => 'Users',
                                'action' => 'edit'
                            ],
                        ]
                    ]  
                ]
            ]
        ]
    ]
];