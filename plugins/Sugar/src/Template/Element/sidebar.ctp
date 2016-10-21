<div class="sugar-sidebar-overlay"></div>

<ul class="nav nav-pills nav-stacked sugar-nav-sidebar main-sidebar">
    <?php foreach ($items as $title => $item): ?>
        <?php if ($title): ?>
            <li class="sugar-sidemenu-title">
                <?= $title ?>
            </li>
        <?php endif ?>
        <?php foreach ($item as $value): ?>
            <?php if (isset($value['submenu'])): ?>

                <li class="has-submenu">
                    <?php
                        $itemsSubmenu = [];
                        
                        foreach ($value['submenu'] as $v) {
                            $hideSubmenu = true;
                            $v['isActive'] = false;

                            if (isset($v['childs'])) {
                                foreach ($v['childs'] as $child) {
                                    if (($child['controller'] == $this->request->params['controller'] && $child['action'] == $this->request->params['action'])) {

                                        $hideSubmenu = false;
                                        $v['isActive'] = true;

                                        break;
                                        
                                    }
                                }
                            }
                            if ($v['url']['controller'] == $this->request->params['controller'] && $v['url']['action'] == $this->request->params['action']) {

                                $hideSubmenu = false;
                                $v['isActive'] = true;
                                
                            }
                            
                            $itemsSubmenu[] = $v;
                        }
                    ?>
                    <a href="#" class="<?= (!$hideSubmenu) ? 'active' : '' ?>">
                        <?= $this->Html->faicon($value['icon']) ?>
                        <?= $value['label'] ?>
                    </a>
                    <ul class="nav nav-pills nav-stacked sugar-nav-sidebar submenu <?= ($hideSubmenu) ? 'sugar-submenu-hidden' : '' ?>">    
                        <?php foreach ($itemsSubmenu as $v): ?>
                            <li>
                                <?= $this->Html->link($v['label'], $v['url'], ['class' => (($v['isActive']) ? 'active' : ''), 'escape' => false]) ?>
                            </li>                    
                        <?php endforeach ?>
                    </ul>
                </li>
            <?php else: ?>
                <?php 
                    $isActive = ($value['url']['controller'] == $this->request->params['controller'] && $value['url']['action'] == $this->request->params['action']);
                ?>
                <li>
                    <?= $this->Html->link($this->Html->faicon($value['icon']) . $value['label'], $value['url'], ['class' => (($isActive) ? 'active' : ''), 'escape' => false]) ?>
                </li>
            <?php endif ?>
        <?php endforeach ?>
        <li class="sugar-sidemenu-separator"></li>
    <?php endforeach ?>
<!--     <li class="has-submenu">
        <a href="#" class="active">
            <span class="fa fa-envelope fa-fw"></span>
            Olá gente
        </a>
        <ul class="nav nav-pills nav-stacked sugar-nav-sidebar submenu">
            <li>
                <a href="#">
                    Oi zhanti
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <span class="fa fa-shopping-cart fa-fw"></span> 
            Olá gente
        </a>
    </li> -->
</ul>