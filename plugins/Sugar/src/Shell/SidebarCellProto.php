<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Sidebar cell
 */
class SidebarCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $items = [
            null => [
                [
                    'label' => 'Posts',
                    'icon' => 'pencil-square-o',
                    'url' => [
                        'controller' => 'Posts',
                        'action' => 'index'
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
        ];

        $this->set(compact('items'));
    }
}
