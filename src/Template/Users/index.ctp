
<!-- Breadcrumb -->
<div class="sugar-breadcrumb">
    <h1>Users</h1>
    <?php
        $this->Html->addCrumb('Users /');
        echo $this->Html->getCrumbList();
    ?>
    <!-- Botão Adicionar registro -->
    <div class="sugar-breadcrumb-tools">
        <?= $this->Html->link('Novo User' , [
            'action' => 'add'
        ], [
            'escape' => false,
            'class' => 'btn btn-default'
        ]) ?>
    </div>
</div>

<?= $this->Flash->render() ?>

<!-- Painel de Busca -->
<div class="panel panel-default sugar-panel-content">
    <div class="panel-body">
        <form action="" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Palavra Chave</label>
                    <input
                        type="text"
                        name="q"
                        placeholder="Name"
                        class="form-control"
                        value="<?= h($this->request->query('q'))?>">
                </div>
                <div class="col-md-8 text-right">
                    <button class="btn btn-danger sugar-main-filter-search">
                        <span class="fa fa-search"></span> Pesquisar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Painel com a tabela -->
<div class="panel panel-default sugar-panel-content">
    <div class="">
        <table class="table table-hover table-striped">
            <!-- Header listando os campos -->
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('password') ?></th>
                    <th><?= $this->Paginator->sort('profile_picture_dir') ?></th>
                    <th><?= $this->Paginator->sort('profile_picture') ?></th>
                    <th><?= $this->Paginator->sort('is_superuser') ?></th>
                    <th><?= $this->Paginator->sort('token') ?></th>
                    <th><?= $this->Paginator->sort('token_expires') ?></th>
                    <th><?= $this->Paginator->sort('api_token') ?></th>
                    <th><?= $this->Paginator->sort('activation_date') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('role_id') ?></th>
                        <th style="width: 120px;">
                    </th>
                </tr>
            </thead>
            <!-- Body com os dados -->
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= h($user->name) ?></td>
                        <td><?= h($user->created) ?></td>
                        <td><?= h($user->modified) ?></td>
                        <td><?= h($user->username) ?></td>
                        <td><?= h($user->password) ?></td>
                        <td><?= h($user->profile_picture_dir) ?></td>
                        <td><?= h($user->profile_picture) ?></td>
                        <td><?= h($user->is_superuser) ?></td>
                        <td><?= h($user->token) ?></td>
                        <td><?= h($user->token_expires) ?></td>
                        <td><?= h($user->api_token) ?></td>
                        <td><?= h($user->activation_date) ?></td>
                        <td><?= h($user->is_active) ?></td>
                        <td><?= $user->has('role') ? $this->Html->label($user->role->name, 'primary') : '' ?></td>
                        <!-- Botões de Ação -->
                    <td class="text-right">
                        <!-- Botão Editar -->
                        <?= $this->Html->link(
                            '<span class="fa fa-pencil"></span>',
                            [
                                'action' => 'edit',
                                $user->id
                            ],
                            [
                                'escape' => false,
                                'class' => 'btn btn-default btn-sm'
                            ])
                        ?>
                        <!-- Botão Remover -->
                        <?= $this->Form->postLink(
                            '<span class="fa fa-remove"></span>',
                            [
                                'action' => 'delete',
                                $user->id],
                            [
                                'escape' => false,
                                'class' => 'btn btn-default btn-sm',
                                'confirm' => __('Você realmente deseja deletar registro de ID {0}?',
                                $user->id)
                            ])
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Paginação -->
<div class="sugar-panel-content">
    <div class="sugar-panel-paginator">
        <span>
            <?php
                echo $this->Paginator->counter('Página <strong>{{page}}</strong>-<strong>{{pages}}</strong> de <strong>{{count}}</strong> registros')
            ?>
        </span>
        <ul class="pagination">
            <?php
                echo $this->Paginator->prev('<span class="fa fa-chevron-left"></span>', ['escape' => false]);
                echo $this->Paginator->next('<span class="fa fa-chevron-right"></span>', ['escape' => false]);
            ?>
        </ul>
    </div>
</div>