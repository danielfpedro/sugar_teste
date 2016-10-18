
<div class="sugar-breadcrumb">
    <h1>Adicionar Post</h1>
    <?php
        $this->Html->addCrumb('Posts', ['action' => 'index']); 
        $this->Html->addCrumb('Adicionar Post');
        echo $this->Html->getCrumbList();
    ?>
</div>

<?= $this->Flash->render() ?>

<?= $this->Form->create($post, [
    'horizontal' => true,
    'novalidate' => true,
    'columns' => [
        'label' => 2,
        'input' => 4,
        'error' => 6
    ]
]) ?>

    <div class="panel panel-default sugar-panel-content sugar-panel-form">
        <div class="panel-body">
        <?php
            echo $this->Form->input('title');
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