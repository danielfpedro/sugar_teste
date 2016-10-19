<?php

namespace App\Auth;

use Cake\Auth\BaseAuthorize;
use Cake\Network\Request;
use Cake\Core\Configure;

class SugarAuthorize extends BaseAuthorize
{
    public function authorize($user, Request $request)
    {
    	$authorizations = Configure::read('authorizations');

    	if (isset($authorizations[$request->params['controller']])) {
    		if (isset($authorizations[$request->params['controller']][$request->params['action']])) {

    			$action = $authorizations[$request->params['controller']][$request->params['action']];

    			if (is_array($action)) {
    				/**
    				 * Uso Foreach em vez de in array pq tenho que levar em conta a ordem que deny e allow aparecem
    				 */
    				$out = true;

    				foreach ($action as $key => $value) {
    					if ($key == 'deny' || $key == 'allow') {
    						$toOut = ($key == 'deny') ? false : true;
		    				if (is_array($value)) {
			    				foreach ($value as $key => $value) {
			    		    		if (strtolower($user['role']['name']) == strtolower($value)) {
				    					$out = $toOut;
				    				}
			    				}
		    				} elseif ($value == '*') {
								$out = $toOut;
		    				}
    					}
    				}
    				return $out;
    			}
    		}
    	}
        return true;
    }
}