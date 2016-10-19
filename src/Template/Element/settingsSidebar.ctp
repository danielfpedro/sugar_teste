<?php

$sidebarItems = [
    [
        'label' => 'Configurações de Perfil',
        'url' => ['controller' => 'Users', 'action' => 'profileSettings']
    ],
    [
        'label' => 'Imagem de Perfil',
        'url' => ['controller' => 'Users', 'action' => 'profileImageSettings']
    ],
    [
        'label' => 'Configurações de Conta',
        'url' => ['controller' => 'Users', 'action' => 'accountSettings']
    ],
    [
        'label' => 'Senha',
        'url' => ['controller' => 'Users', 'action' => 'passwordSettings']
    ],
];
?>
<ul class="nav nav-pills nav-stacked">
    <?php foreach ($sidebarItems as $key => $value): ?>
        <li class="<?= ($this->request->params['action'] == $value['url']['action']) ? 'active' : '' ?>">
            <?= $this->Html->link($value['label'], $value['url']) ?>
        </li>
    <?php endforeach ?>
</ul>