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

                            if ($v['url']['controller'] == $this->request->params['controller'] && $v['url']['action'] == $this->request->params['action']) {

                                $hideSubmenu = false;
                                $v['isActive'] = true;
                                
                            }

                            if (!$v['isActive'] && isset($v['childs'])) {
                                foreach ($v['childs'] as $child) {

                                    $actions = explode('|', $child['action']);

                                    if (
                                        in_array($this->request->params['action'], $actions) &&
                                        $this->request->params['controller'] == $child['controller']
                                    ) {

                                        $hideSubmenu = false;
                                        $v['isActive'] = true;

                                        break;
                                        
                                    }
                                }
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
                                <?= $this->Html->link(
                                    $v['label'],
                                    $v['url'],
                                    [
                                        'class' => (($v['isActive']) ? 'active' : ''),
                                        'escape' => false
                                    ])
                                ?>
                            </li>                    
                        <?php endforeach ?>
                    </ul>
                </li>
            <?php else: ?>
                <?php 

                    $isActive = ($value['url']['controller'] == $this->request->params['controller'] && $value['url']['action'] == $this->request->params['action']);

                    if (!$isActive && isset($value['childs'])) {
                        foreach ($value['childs'] as $k => $v) {

                            $actions = explode('|', $v['action']);

                            if (
                                $this->request->params['controller'] == $v['controller'] &&
                                in_array($this->request->params['action'], $actions)
                            ) {
                                $isActive = true;
                            }
                        }
                    }
                ?>
                <li>
                    <?= $this->Html->link($this->Html->faicon($value['icon']) . $value['label'], $value['url'], ['class' => (($isActive) ? 'active' : ''), 'escape' => false]) ?>
                </li>
            <?php endif ?>
        <?php endforeach ?>
        <li class="sugar-sidemenu-separator"></li>
    <?php endforeach ?>
</ul>