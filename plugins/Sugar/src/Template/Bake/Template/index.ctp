<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    });

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
    $fields = $fields->reject(function ($field) {
        return $field === 'lft' || $field === 'rght';
    });
}

if (!empty($indexColumns)) {
    $fields = $fields->take($indexColumns);
}

if (isset($modelObject))
{
    $displayField = $modelObject->displayfield();
}

%>

<!-- Breadcrumb -->
<div class="sugar-breadcrumb">
    <h1><%= $pluralHumanName %></h1>
    <?php
        $this->Html->addCrumb('<%= $pluralHumanName %> /');
        echo $this->Html->getCrumbList();
    ?>
    <!-- Botão Adicionar registro -->
    <div class="sugar-breadcrumb-tools">
        <?= $this->Html->link('Novo <%= $singularHumanName %>' , [
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
                        placeholder="<%= $this->_pluralHumanName($displayField) %>"
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
    <% foreach ($fields as $field): %>
                <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
    <% endforeach; %>
                    <th style="width: 120px;">
                    </th>
                </tr>
            </thead>
            <!-- Body com os dados -->
            <tbody>
                <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
                <tr>
    <%        foreach ($fields as $field) {
                $isKey = false;
                if (!empty($associations['BelongsTo'])) {
                    foreach ($associations['BelongsTo'] as $alias => $details) {
                        if ($field === $details['foreignKey']) {
                            $isKey = true;
    %>
                    <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->label($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, 'primary') : '' ?></td>
    <%
                            break;
                        }
                    }
                }
                if ($isKey !== true) {
                    if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
    %>
                    <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
    <%
                    } else {
    %>
                    <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
    <%
                    }
                }
            }

            $pk = '$' . $singularVar . '->' . $primaryKey[0];
    %>
                    <!-- Botões de Ação -->
                    <td class="text-right">
                        <!-- Botão Editar -->
                        <?= $this->Html->link(
                            '<span class="fa fa-pencil"></span>',
                            [
                                'action' => 'edit',
                                <%= $pk %>
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
                                <%= $pk %>],
                            [
                                'escape' => false,
                                'class' => 'btn btn-default btn-sm',
                                'confirm' => __('Você realmente deseja deletar registro de ID {0}?',
                                <%= $pk %>)
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