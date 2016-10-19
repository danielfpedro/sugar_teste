<?php
namespace Sugar\View\Helper;

use Cake\View\Helper;

class SugarHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function shortName($name)
    {
    	$array = explode(' ', $name);
    	$total = count($array);
    	if ($total > 1) {
    		return $array[0] . ' ' . $array[$total - 1];
    	}
    	return $array[0];
    }

}
