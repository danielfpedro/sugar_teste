<?php
namespace Sugar\View\Cell;

use Cake\View\Cell;
use Cake\Core\Configure;

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
        Configure::load('sidebar_items');
        $items = Configure::read('items');
        $this->set(compact('items'));
    }
}
