<div class="sugar-breadcrumb">
    <h1>Configurações de Senha</h1>
    <?php
        $this->Html->addCrumb('Configurações de senha');
        echo $this->Html->getCrumbList();
    ?>
</div>

<?= $this->Flash->render() ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?= $this->element('settingsSidebar') ?>
        </div>
        <div class="col-md-9">
            <?= $this->Form->create($user, [
                'horizontal' => true,
                'novalidate' => true,
                'columns' => [
                    'label' => 2,
                    'input' => 5,
                    'error' => 5
                ]
            ]) ?>

                <div class="panel panel-default sugar-panel-content sugar-panel-form">
                    <div class="panel-body">
                        <?php
                            echo $this->Form->input('new_password');
                            echo $this->Form->input('confirm_new_password');
                        ?>
                    </div>
                </div>

                <div class="panel panel-default sugar-panel-content sugar-panel-form">
                    <div class="panel-body">
                        <?php
                            echo $this->Form->input('current_password', [
                                'help' => 'Para a sua segurança você deve confirmar a sua senha atual.'
                            ]);
                        ?>
                    </div>
                </div>

                <div class="panel panel-default sugar-panel-content">
                    <div class="panel-body text-right">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-check"></span> Salvar
                        </button>
                    </div>
                </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>