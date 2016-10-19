<?php

use Cake\Event\Event;
use Cake\Event\EventManager;

/**
 * Additional bootstrapping and configuration for CLI environments should
 * be put here.
 */

EventManager::instance()->on('Bake.beforeRender.Controller.controller', function (Event $event) {
    
        $view = $event->subject();

        $view->viewVars['actions'] = [
            'index',
            // 'add',
            // 'edit',
            // 'delete'
        ];

        if ($view->viewVars['name'] == 'Users') {
            $view->viewVars['actions'][] = 'login';
            $view->viewVars['actions'][] = 'logout';
            $view->viewVars['actions'][] = 'profileSettings';
        }
    }
);